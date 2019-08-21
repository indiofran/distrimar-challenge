<?php


class EmployeeTest extends TestCase
{
	public function testEmptyRequest()
	{
		$this->get('/offices');

		$this->assertEquals(
			json_encode(\App\Office::paginate(10,['*'], 'p')), $this->response->getContent()
		);
	}

	public function testIdRequest()
	{
		for ($i = 1;$i <= \App\Office::all()->count(); $i++){
			$this->get('/offices/'.$i);
			$this->assertEquals(
				\App\Office::find($i), $this->response->getContent()
			);
		}
	}

	public function testDefaultPageRequest($employeePerPage = 10)
	{

		$employees = \App\Office::paginate($employeePerPage, ['*'], 'p');
		$pages = $employees->count();
		for ($i = 1;$i <= $pages; $i++) {
			$this->get("/offices?p=$i&cant=$employeePerPage");
			$this->assertSame(
				json_encode(\App\Office::paginate($employeePerPage, ['*'], 'p',$i)), $this->response->getContent()
			);
		}
	}

	public function testPageRequest()
	{
		for ($i = 1; $i < 10; $i++){
			$this->testDefaultPageRequest($i);
		}
	}

	public function testRelRequest($rel = [] )
	{
		$reltext = '';
		foreach ($rel as $index => $relation){
			if($index == 0 ){
				$reltext .= "rel[]=$relation";
			}else{
				$reltext .= "&rel[]=$relation";
			}
		}
		$this->get("/offices?$reltext");
		$this->assertEquals(
			json_encode(\App\Office::with($rel)->paginate(10,['*'],'p')), $this->response->getContent()
		);
	}
	public function testDiferentRel()
	{
		$rels = array(
			array('employees'),
			array('employees.department'),
			array('employees.manager'),
		);
		foreach ($rels as $rel){
			$this->testRelRequest($rel);
		}
	}
}
