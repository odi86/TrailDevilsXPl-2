<?php
require_once(dirname(__FILE__) . '/../lib/simpletest/extensions/TraildevilsUnitTestCase.php');
require_once(dirname(__FILE__) . '/../../../php/domain/TrailsLoader.class.php');

/**
 * Description of TestTrailsLoader
 *
 * @author odi
 */
class TestTrailsLoader extends TraildevilsUnitTestCase 
{
	protected $loader;

	function setUp() {
		$this->loader = new TrailsLoader();
	}

	function tearDown() {
		$this->loader = null;
	}
	
	function testConvertJsonKeys()
	{
		 $convertedJson = json_decode($this->loader->convertTrailsJson($this->getTestTrailJson(), $this->getTestGeoLocation(), 10, 1, $this->getTestSortArray()), true);
		 $this->checkJsonFormat($convertedJson["trails"][0]);
	}
	
	function testConvertJsonValues()
	{
		 $location = $this->getTestGeoLocation();
		 $convertedJson = json_decode($this->loader->convertTrailsJson($this->getTestTrailJson(), $location, 10, 1,$this->getTestSortArray()), true);
		 $this->assertEqual(count($convertedJson["trails"]), 3, "Array should contain exactly 3 trails: %s");
		 
		 $values = $convertedJson["trails"][0];
		 $this->assertEqual($values["title"], "Testtrail");
		 $this->assertEqual($values["location"], "Zürich, Switzerland");
		 $this->assertEqual($values["distance"], 0.0);
		 $this->assertEqual($values["thumb"], "data:image/jpeg;base64,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");
		 $this->assertEqual($values["description"], "Test-Description");
		 $this->assertEqual($values["status"], "geschlossen");
		 $this->assertEqual($values["latitude"], $location->getLatitude());
		 $this->assertEqual($values["longitude"], $location->getLongitude());
	}
	
	function testGetTrailsNearWithLocalAPI() {
        $url = "file://".dirname(__FILE__)."/../trails.json";
		$location = $this->getTestGeoLocation();
		
		$localJson = $this->loader->convertTrailsJson($this->getTestTrailJson(), $location, 10, 1, $this->getTestSortArray());
		$this->checkJson($localJson);
		
		$result = $this->loader->getTrailsNear($location->getLatitude(),$location->getLongitude(), 10, 1, $this->getTestSortJson(), $url);
		$this->assertEqualsIgnoreWhitespace($result,$localJson);
    }
	
	function testGetTrailsNearWithRemoteAPIAndLocation() {
		$location = $this->getTestGeoLocation();
		
		$remoteJson = $this->loader->getTrailsNear($location->getLatitude(),$location->getLongitude(), 10, 1, $this->getTestSortJson("distance"));
		$this->checkJson($remoteJson);
    }
	
	function testGetTrailsNearWithRemoteAPIWithoutLocation() {
		$location = $this->getTestGeoLocation();
		
		$remoteJson = $this->loader->getTrailsNear($location->getLatitude(),$location->getLongitude(),  10, 1, $this->getTestSortJson("title"));
		$this->checkJson($remoteJson,array("title","location","thumb","description","status","latitude","longitude"));
    }
	
	function checkJson($json,$keys = array("title","location","distance","thumb","description","status","latitude","longitude")) {
		$jsonArray = json_decode($json, true);
		$this->checkJsonFormat($jsonArray["trails"][0],$keys);
	}
	
	function checkJsonFormat($json,$keys = array("title","location","distance","thumb","description","status","latitude","longitude")) {
		foreach ($keys as $key)
		{
			$this->assertTrue(array_key_exists($key, $json),"Key \"$key\" must exist in converted JSON array.");
		}
	}
}

?>
