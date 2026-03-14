<?php

class EnhancedBusManager {
    private $buses = [];
    private $students = [];
    private $fuelRecords = [];
    private $maintenanceRecords = [];

    public function addBus($busId, $busDetails) {
        $this->buses[$busId] = $busDetails;
    }

    public function assignStudentToBus($studentId, $busId) {
        if (!isset($this->students[$studentId])) {
            $this->students[$studentId] = [];
        }
        $this->students[$studentId][] = $busId;
    }

    public function trackFuelUsage($busId, $amount) {
        if (!isset($this->fuelRecords[$busId])) {
            $this->fuelRecords[$busId] = [];
        }
        $this->fuelRecords[$busId][] = ['date' => date('Y-m-d H:i:s'), 'amount' => $amount];
    }

    public function recordMaintenance($busId, $details) {
        if (!isset($this->maintenanceRecords[$busId])) {
            $this->maintenanceRecords[$busId] = [];
        }
        $this->maintenanceRecords[$busId][] = ['date' => date('Y-m-d H:i:s'), 'details' => $details];
    }

    public function getBusDetails($busId) {
        return isset($this->buses[$busId]) ? $this->buses[$busId] : null;
    }

    public function getStudentAssignments($studentId) {
        return isset($this->students[$studentId]) ? $this->students[$studentId] : [];
    }

    public function getFuelRecords($busId) {
        return isset($this->fuelRecords[$busId]) ? $this->fuelRecords[$busId] : [];
    }

    public function getMaintenanceRecords($busId) {
        return isset($this->maintenanceRecords[$busId]) ? $this->maintenanceRecords[$busId] : [];
    }
}

// Example Usage:
//$busManager = new EnhancedBusManager();
//$busManager->addBus('Bus1', ['capacity' => 50, 'route' => 'A-B']);
//$busManager->assignStudentToBus('Student1', 'Bus1');
//$busManager->trackFuelUsage('Bus1', 100);
//$busManager->recordMaintenance('Bus1', 'Changed tires');
?>