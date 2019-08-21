<?php


class EmployeeTest extends TestCase
{
	public function testEmptyRequest()
	{
		$this->get('/employees');

		$this->assertEquals(
			json_encode(\App\Employee::paginate(10,['*'], 'p')), $this->response->getContent()
		);
	}

	public function testIdRequest()
	{
		for ($i = 1;$i <= \App\Employee::all()->count(); $i++){
			$this->get('/employees/'.$i);
			$this->assertEquals(
				\App\Employee::find($i), $this->response->getContent()
			);
		}
	}

	public function testDefaultPageRequest($employeePerPage = 10)
	{

		$employees = \App\Employee::paginate($employeePerPage, ['*'], 'p');
		$pages = $employees->count();
		for ($i = 1;$i <= $pages; $i++) {
			$this->get("/employees?p=$i&cant=$employeePerPage");
			$this->assertSame(
				json_encode(\App\Employee::paginate($employeePerPage, ['*'], 'p',$i)), $this->response->getContent()
			);
		}
	}

	public function testPageRequest()
	{
		for ($i = 1; $i < 50; $i++){
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
		$this->get("/employees?$reltext");
		$this->assertEquals(
			json_encode(\App\Employee::with($rel)->paginate(10,['*'],'p')), $this->response->getContent()
		);
	}
	public function testDiferentRel()
	{
		$rels = array(
			array('manager'),
			array('department.superdepartment', 'office'),
			array('manager.office','department'),
			array('manager.office','manager.department'),
			array('manager','manager.department','department.superdepartment'),
		);
		foreach ($rels as $rel){
			$this->testRelRequest($rel);
		}
	}
}
