<?php namespace Survey\Commands;

use Survey\Commands\Command;

use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldBeQueued;
use Survey\Result;

class CollectResultsCommand extends Command implements SelfHandling {

	use SerializesModels;

	public $result;

	/**
	 * Create a new command instance.
	 *
	 * @param Result $result
	 */
	public function __construct(Result $result)
	{
		$this->result = $result;
	}

	/**
	 * Execute the command.
	 *
	 * @return void
	 */
	public function handle()
	{
		//dd($this->result->answers);
		$all_answers = $this->result->answers->groupBy('question');

		$questions = $this->result->survey->questions;
		$i=0;
		foreach($questions as $section)
		{
			$data[$i]['name'] = $section['title'];
			$q = 0;

			foreach ($section['questiongroups'] as $questiongroup)
			{
				$data[$i]['questiongroups'][$q]['name'] = $questiongroup['heading'];
				$data[$i]['questiongroups'][$q]['type'] = $questiongroup['type'];
				$data[$i]['questiongroups'][$q]['condition'] = $questiongroup['condition'];
				switch($questiongroup['type'])
				{
					case 1:
						$a=0;
						if (isset($all_answers[$questiongroup['id']])) {
							$answers = $all_answers[$questiongroup['id']];

							foreach($answers as $answer)
							{
								$data[$i]['questiongroups'][$q]['answers'][$a] = $answer->text;
								$a++;
							}
						}
						break;
					case 2:
						$a=0;
						$answers = $all_answers[$questiongroup['id']];
						$part = 0;
						$sol = array();
						foreach ($answers as $answer) {
							$part++;
							if(isset($sol[$answer->answer]))
								$sol[$answer->answer]++;
							else
								$sol[$answer->answer]=1;
						}
						$res = array();
						foreach($questiongroup['questions'] as $question)
						{
							if(!isset($sol[$question['id']]))
								$sol[$question['id']]=0;
							$res[$a]['vote'] = $question['content'];
							$res[$a]['absolut'] = $sol[$question['id']];
							$res[$a]['percent'] = ($sol[$question['id']]/$part)*100;
							$a++;
						}
						$data[$i]['questiongroups'][$q]['answers']= $res;
						$data[$i]['questiongroups'][$q]['participants']= $part;
						break;

					case 3:
						$a = 0;
						foreach ($questiongroup['questions'] as $question) {
							echo $question['id'];
							$answers = $all_answers[$question['id']];
							$part = 0;
							$sol = array(0, 0, 0, 0, 0, 0);
							//dd($answers);
							foreach ($answers as $answer) {
								$part++;
								$sol[$answer->answer]++;
							}
							foreach ($sol as $key => $so) {
								$votes[$key]['absolut'] = $so;
								$votes[$key]['percent'] = ($so / $part) * 100;
								$votes[$key]['vote'] = $key;
							}
							$data[$i]['questiongroups'][$q]['answers'][$a]['participants'] = $part;
							$data[$i]['questiongroups'][$q]['answers'][$a]['name'] = $question['content'];
							$data[$i]['questiongroups'][$q]['answers'][$a]['votes'] = $votes;
							$a++;
						}
						break;
				}
				$q++;
			}
			$i++;
		}
		$this->result->data = $data;
		//dd($data);
		$this->result->processing = false;
		$this->result->save();
	}

}
