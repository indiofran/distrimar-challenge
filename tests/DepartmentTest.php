<?php


class EmployeeTest extends TestCase
{
	public function testEmptyRequest()
	{
		$this->get('/departments');

		$this->assertEquals(
			json_encode(\App\Department::paginate(10,['*'], 'p')), $this->response->getContent()
		);
	}

	public function testIdRequest()
	{
		for ($i = 1;$i <= \App\Department::all()->count(); $i++){
			$this->get('/departments/'.$i);
			$this->assertEquals(
				\App\Department::find($i), $this->response->getContent()
			);
		}
	}

	public function testDefaultPageRequest($employeePerPage = 10)
	{

		$employees = \App\Department::paginate($employeePerPage, ['*'], 'p');
		$pages = $employees->count();
		for ($i = 1;$i <= $pages; $i++) {
			$this->get("/departments?p=$i&cant=$employeePerPage");
			$this->assertSame(
				json_encode(\App\Department::paginate($employeePerPage, ['*'], 'p',$i)), $this->response->getContent()
			);
		}
	}

	public function testPageRequest()
	{
		for ($i = 1; $i < 20; $i++){
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
		$this->get("/departments?$reltext");
		$this->assertEquals(
			json_encode(\App\Department::with($rel)->paginate(10,['*'],'p')), $this->response->getContent()
		);
	}
	public function testDiferentRel()
	{
		$rels = array(
			array('employees'),
			array('employees.department.superdepartment', 'superdepartment'),
			array('employees.manager.office','superdepartment'),
		);
		foreach ($rels as $rel){
			$this->testRelRequest($rel);
		}
	}
}
