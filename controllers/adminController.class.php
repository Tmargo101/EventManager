<?php

require_once 'database/dbaccess_admin.class.php';

/** @noinspection PhpUnused EntryPoints */

class AdminController {

    /** @noinspection PhpUnused */
    public static function getAllAttendees() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("a.idattendee, a.name, r.name AS role", "attendee", "AS a LEFT JOIN role AS r ON a.role = r.idrole", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllEvents() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("e.idevent, e.name, e.datestart, e.dateend, e.numberallowed, v.name AS venue", "event", "AS e LEFT JOIN venue AS v ON v.idvenue = e.venue", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllSessions() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("*", "session", "", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    /** @noinspection PhpUnused */
    public static function getAllVenues() {
        $db = new DBAccess_Admin();
        $data = $db->getAllRowsFromTable("*", "venue", "", "class");
        if (count($data) > 0) {
            return $data;
        } else {
            return null;
        }
    }

    public static function createNewAttendee($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addAttendee($inPOSTValues['newUserName'], $inPOSTValues['newPassword'], $inPOSTValues['newRole']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Created:</strong><br>
        User '{$inPOSTValues['newUserName']}' has been created.
    </div>
</div>";

        } else {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Error:</strong><br>
        User '{$inPOSTValues['newUserName']}' was not created.
    </div>
</div>";
        }
    }

    public static function createNewVenue($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addVenue($inPOSTValues['newVenueName'], $inPOSTValues['newVenueCapacity']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Created:</strong><br>
        Venue '{$inPOSTValues['newVenueName']}' has been created.
    </div>
</div>";
        } else {
            echo "
<div class='alert alert-danger'>
    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
        <span aria-hidden='true'>&times;</span>
    </button>
    <strong>Error:</strong><br>
    Venue '{$inPOSTValues['newVenueName']}' was not created.
</div>";

        }
    }

    public static function createNewEvent($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addEvent($inPOSTValues['newEventName'], $inPOSTValues['newEventStartDate'], $inPOSTValues['newEventEndDate'], $inPOSTValues['newEventNumberAllowed'], $inPOSTValues['newEventVenue']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Created:</strong><br>
        Event '{$inPOSTValues['newEventName']}' has been created.
    </div>
</div>";
        } else {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-danger'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Error:</strong><br>
        Event '{$inPOSTValues['newEventName']}' was not created.
    </div>
</div>";

        }
    }

    public static function createNewSession($inPOSTValues) {
        $db = new DBAccess_Admin();
        $success = $db->addSession($inPOSTValues['newSessionName'], $inPOSTValues['newSessionStartDate'], $inPOSTValues['newSessionEndDate'], $inPOSTValues['newSessionNumberAllowed'], $inPOSTValues['newSessionEvent']);
        if ($success != -1) {
            echo "
<div class='container col-md-4'>
    <div class='alert alert-success'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
        </button>
        <strong>Created:</strong><br>
        Session '{$inPOSTValues['newSessionName']}' has been created.
    </div>
</div>";
        } else {
            echo "<h1>User {$inPOSTValues['newUserName']} Was not created.</h1>";
        }
    }

    //////////////////////////////////////// START REGISTRATION FUNCTIONS ////////////////////////////////////////
    public static function registerEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->registerEvent($eventId,$attendeeId);
    }
    public static function unregisterEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->unregisterEvent($eventId,$attendeeId);

    }

    public static function registerSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->registerSession($sessionId,$attendeeId);

    }
    public static function unregisterSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        return $db->unregisterSession($sessionId,$attendeeId);

    }

    public static function checkIfRegisteredEvent($eventId, $attendeeId) {
        $db = new DBAccess_Admin();
        $isRegistered = $db->checkIfRegisteredEvent($eventId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    public static function checkIfRegisteredSession($sessionId, $attendeeId) {
        $db = new DBAccess_Admin();
        $isRegistered = $db->checkIfRegisteredSession($sessionId, $attendeeId);
        if ($isRegistered == true) {
            return true;
        } else {
            return false;
        }
    }

    //////////////////////////////////////// END REGISTRATION FUNCTIONS ////////////////////////////////////////





//        public static function getAllUsersTable() {
//			$db = new DBAccess_Admin();
//			$data = $db->getAllAttendees();
//			$numRecords = count($data);
//
//			$userTableOutput = "<h5>There are {$numRecords} total users registered.</h5>";
//			if (count($data) > 0) {
//				// Create the table and the table header
//				$userTableOutput .= "<div class='pb-2'><table class='table table-striped'>\n
//								<thead class='thead-dark'>
//								<tr>
//									<th>Attendee ID</th>
//									<th>Name</th>
//									<th>Role</th>
//									<th>Controls</th>
//								</tr>\n
//								</thead>\n";
//
//				// Create the table rows from the data input
//				foreach ($data as $row) {
//					$userTableOutput .= "<tr>";
//					// Created method in person.class.php to return a string which is a row (THIS IS HOW TO GET DATA OUT OF A PDO
//					$userTableOutput .= $row->returnColumns();
//					$userTableOutput .= $row->returnActionColumn();
//					$userTableOutput .= "</tr>";
//				}
//
//				// Close the table
//				$userTableOutput .= "</table></div>\n";
//			} else {
//				$userTableOutput = "<h2>No people exist.</h2>";
//			}
//
//			return $userTableOutput;
//		}
//
//		public static function getAllEventsTable() {
//			$db = new DBAccess_Admin();
//			$data = $db->getAllEvents();
//			$numRecords = count($data);
//
//			$eventTableOutputString = "<h5>There are {$numRecords} total events registered.</h5>";
//			if (count($data) > 0) {
//				// Create the table and the table header
//				$eventTableOutputString .= "<div class='pb-2'><table class='table table-striped'>\n
//								<thead class='thead-dark'>
//								<tr>
//									<th>Event ID</th>
//									<th>Event Name</th>
//									<th>Start Date</th>
//									<th>End Date</th>
//									<th>Max Attendees</th>
//									<th>Venue ID</th>
//									<th>Controls</th>
//								</tr>\n
//								</thead>\n";
//
//				// Create the table rows from the data input
//				foreach ($data as $row) {
//					$eventTableOutputString .= "<tr>";
//					$eventTableOutputString .= $row->returnColumns();
//					$eventTableOutputString .= $row->returnActionColumn();
//					$eventTableOutputString .= "</tr>";
//				}
//
//				// Close the table
//				$eventTableOutputString .= "</table></div>\n";
//			} else {
//				$eventTableOutputString = "<h2>No Events exist.</h2>";
//			}
//
//			return $eventTableOutputString;
//		}
} // End adminDB
