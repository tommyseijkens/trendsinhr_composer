<?php

/**
 * {@inheritdoc}
 */
class EventFunctions extends ConnectApi {

	/**
	 * Detail ID.
	 *
	 * @var string
	 */
	public $detailId;

	/**
	 * Detail.
	 *
	 * @var array
	 */
	public $detail;

	/**
	 * Events.
	 *
	 * @var array
	 */
	public $events;

	/**
	 * Events Group Id.
	 *
	 * @var array
	 */
	public $eventsGroupId;

	/**
	 * Events Parent ID.
	 *
	 * @var array
	 */
	public $eventsParentId;

	/**
	 * Events for Parent.
	 *
	 * @var array
	 */
	public $eventsForParent;

	/**
	 * Events Group.
	 *
	 * @var array
	 */
	public $eventsGroups;

	/**
	 * Root events.
	 *
	 * @var bool
	 */
	private $rootEvents;

	/**
	 * Parent events.
	 *
	 * @var bool
	 */
	private $parentEvents;

	/**
	 * Constructor.
	 */
	public function __construct() {
		// Set root events default.
		$this->rootEvents = false;

		// Set parent events default.
		$this->parentEvents = false;
	}

	/**
	 * Set Detail ID.
	 *
	 * @param string $id
	 *   Setting detail ID.
	 */
	public function setDetailId( $id ) {
		$this->detailId = $id;
	}

	/**
	 * Delete subscription.
	 *
	 * @param string $identifier
	 *   Subscription ID.
	 */
	public function removeParticipant( $identifier ) {
		$this->request( 'DELETE', 'Event/RemoveParticipant?identifier=' . $identifier );
	}

	/**
	 * RootEvents.
	 */
	public function rootEvents() {
		$this->rootEvents = true;

		return $this;
	}

	/**
	 * SetEventGroupId.
	 */
	public function setEventsGroupId( $id ) {
		$this->eventsGroupId = $id;

		return $this;
	}

	/**
	 * Parse Events for parent-link.
	 *
	 * @return $this
	 *   Method.
	 */
	public function parseEventsLinkToParent() {
		foreach ( $this->events as $key => $event ) {
			if ( isset( $event->ParentId ) ) {
				$this->events[ $key ]->Id = $event->ParentId;
			}
		}

		return $this;
	}

	/**
	 * Parse Events with Duration.
	 *
	 * @return $this
	 *   Method.
	 */
	public function parseEventsDuration() {
		foreach ( $this->events as $key => $event ) {
			$this->events[ $key ]->Duration = $this->request( 'GET', 'Event/DetermineDurationForEvent?eventId=' . $event->OriginalId );
		}

		return $this;
	}

	/**
	 * Parse events with groups.
	 *
	 * @return $this
	 *   Method.
	 */
	public function parseEventsWithGroups() {
		if ( isset( $this->events ) ) {

			// Get groups for matching.
			$this->eventsGroups = $this->request( 'GET', 'Event/EventGroups/' );

			foreach ( $this->events as $key => $event ) {
				if ( ! empty( $this->eventsGroups ) ) {
					$this->events[ $key ]->EventGroup = $this->eventsGroups[ array_search( $event->EventGroupId, array_column( $this->eventsGroups, 'Id' ) ) ];
				}
			}
		}

		return $this;
	}

	/**
	 * Parse events with image.
	 *
	 * @return $this
	 *   Method.
	 */
	public function parseEventsImages() {
		if ( isset( $this->events ) ) {
			foreach ( $this->events as $key => $event ) {
				$this->events[ $key ]->HeaderRendered = $this->getImage( $this->request( 'GET', 'Event/MediaDetails/' . $event->HeaderThumbnailId ) );
			}
		}

		return $this;
	}

	/**
	 * Image to base64.
	 *
	 * @param $input
	 *   Image array.
	 *
	 * @return string
	 *   Base64.
	 */
	public function getImage( $input ) {
		if ( isset( $input->Bytes ) ) {
			$response = base64_encode( implode( array_map( "chr", $input->Bytes ) ) );

			return $response;
		}

		return false;
	}

	/**
	 * Get default detail pages values.
	 *
	 * @return array
	 *   Returning detailed page.
	 */
	public function detail() {

		// Get default data.
		$detail                 = $this->request( 'GET', 'Event/EventDetails/' . $this->detailId );
		$detail->StartDateTime  = strtotime( $detail->StartDate );
		$detail->Price          = number_format( $detail->Price, 2, ',', '.' );
		$detail->LabelsRendered = $this->commaToArray( $detail->Labels );

		// Get additional info.
		$detail->MethodsRendered     = $this->request( 'GET', 'Event/Methods/' );
		$detail->Method              = $detail->MethodsRendered[ array_search( $detail->MethodId, array_column( $detail->MethodsRendered, 'Id' ) ) ];
		$detail->EventTypesRendered  = $this->request( 'GET', 'Event/EventTypes/' );
		$detail->EventType           = $detail->EventTypesRendered[ array_search( $detail->EventTypeId, array_column( $detail->EventTypesRendered, 'Id' ) ) ];
		$detail->LocationRendered    = $this->request( 'GET', 'Location/LocationDetails/' . $detail->LocationId );
		$detail->EventGroupsRendered = $this->request( 'GET', 'Event/EventGroups/' );
		$detail->EventGroup          = $detail->EventTypesRendered[ array_search( $detail->CategoryId, array_column( $detail->EventGroupsRendered, 'Id' ) ) ];
		$detail->Program             = $this->sortProgram( $this->request( 'GET', 'Event/Program/' . $this->detailId ) );

		// Single event with no parent id.
		if ( ! isset( $detail->ParentId ) ) {
			$detail->ParentId = null;
			$this->parentEvents()
			     ->setEventsParentId( $this->detailId )
			     ->requestEvents()
			     ->getEvents();
		} else {
			$this->parentEvents()
			     ->setEventsParentId( $detail->ParentId )
			     ->requestEvents()
			     ->getEvents();

		}
		$detail->EventsForParent            = $this->eventsForParent;
		$detail->EventsForParentCanRegister = $this->eventsForParentCanRegister( $this->eventsForParent );
		$detail->DifferentDatesProgram      = $this->checkDifferentDatesProgram( $detail->Program );

		// Image.
		$detail->Photos         = $this->getPhotos( $this->detailId );
		$detail->HeaderRendered = $this->request( 'GET', 'Event/MediaDetails/' . $detail->HeaderId, '' );
		$detail->HeaderRendered = $this->getImage( $detail->HeaderRendered );
		$this->detail           = $detail;

		return $this;
	}

	/**
	 * Comma based variable to array.
	 *
	 * @param string $input
	 *   List.
	 *
	 * @return array
	 *   Array with values.
	 */
	public function commaToArray( $input ) {
		$response = explode( ',', $input );

		return $response;
	}

	/**
	 * Sort program by time.
	 *
	 * @param array $program
	 *   Array with program.
	 *
	 * @return array
	 *   Sorted program.
	 */
	public function sortProgram( array $program ) {
		if ( ! empty( $program ) ) {
			$rows = $program;
			foreach ( $rows as $key => $row ) {
				$date[ $key ] = strtotime( $row->StartDateTime );
				if ( ! empty( $row->LocationId ) ) {
					$row->LocationRendered = $this->request( 'GET', 'Location/LocationDetails/' . $row->LocationId, '' );
				}
				$row->StartDateTime = strtotime( $row->StartDateTime );
				$row->EndDateTime   = strtotime( $row->EndDateTime );
			}
			array_multisort( $date, SORT_ASC, $rows );
		} else {
			$rows = false;
		}

		return $rows;
	}

	/**
	 * Return Events.
	 */
	public function getEvents() {
		return $this->events;
	}

	/**
	 * Set events.
	 */
	public function setEvents( $events ) {
		$this->events = $events;

		return $this;
	}

	/**
	 * Request Events.
	 *
	 * @return $this
	 *   Returning method.
	 */
	public function requestEvents() {
		if ( $this->rootEvents ) {

			if ( isset( $this->eventsGroupId ) ) {
				$this->events = $this->request( 'GET', 'Event/RootEventsForGroup?groupId=' . $this->eventsGroupId );
			} else {
				$this->events = $this->request( 'GET', 'Event/RootEvents' );
			}
		} else {
			if ( isset( $this->eventsGroupId ) ) {

				$this->events = $this->request( 'GET', 'Event/EventsForGroup?groupId=' . $this->eventsGroupId );
			} else {
				$this->events = $this->request( 'GET', 'Event/Events/' );
			}
		}
		if ( $this->parentEvents ) {
			$this->eventsForParent = $this->request( 'GET', 'Event/EventsForParent?parentId=' . $this->eventsParentId, '' );
			$this->eventsForParent = $this->parseEvents( $this->eventsForParent );
		} else {
			$this->events = $this->parseEvents( $this->events );
		}

		return $this;
	}

	/**
	 * Parse events default.
	 *
	 * @param $events
	 *   Events.
	 *
	 * @return array
	 *   Returning method.
	 */
	private function parseEvents( $events ) {
		if ( isset( $events ) ) {
			foreach ( $events as $key => $event ) {
				$events[ $key ]->OriginalId    = $event->Id;
				$events[ $key ]->StartDateTime = strtotime( $event->StartDate );
			}
		}

		return $events;
	}

	/**
	 * SetEventParentId.
	 */
	public function setEventsParentId( $id ) {
		$this->eventsParentId = $id;

		return $this;
	}

	/**
	 * Return Events.
	 */
	public function parentEvents() {
		$this->parentEvents = true;

		return $this;
	}

	/**
	 * Check if events has a true CanRegister field.
	 *
	 * @param $events
	 *   Array with events.
	 *
	 * @return bool
	 *   Returning boolean.
	 */
	public function eventsForParentCanRegister( $events ) {
		if ( isset( $events ) ) {
			foreach ( $events as $value ) {
				if ( $value->CanRegister ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Check for different dates.
	 *
	 * @param $program
	 *   Setting $program.
	 *
	 * @return bool
	 *   Returning boolean.
	 */
	public function checkDifferentDatesProgram( $program ) {
		$dateArray = [];
		if ( ! empty( $program ) ) {
			foreach ( $program as $item ) {
				$date = date( 'm/d/Y', $item->StartDateTime );
				if ( ! in_array( $date, $dateArray ) ) {
					$dateArray[] = $date;
				}
			}
			if ( count( $dateArray ) > 1 ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Get photos.
	 */
	public function getPhotos() {
		$photos   = $this->request( 'GET', 'Event/EventMedia/' . $this->detailId, '' );
		$response = [];
		foreach ( $photos as $photo ) {
			$response[ $photo->Id ] = $this->getImage( $photo );
		}

		return $response;
	}

	/**
	 * Get program for $events.
	 */
	public function programForEvents() {
		// Get program.
		if ( ! empty( $this->detail->EventsForParent ) ) {
			foreach ( $this->detail->EventsForParent as $key => $event ) {
				$this->detail->EventsForParent[ $key ]->Program               = $this->sortProgram( $this->request( 'GET', 'Event/Program/' . $event->Id ) );
				$this->detail->EventsForParent[ $key ]->DifferentDatesProgram = $this->checkDifferentDatesProgram( $this->detail->EventsForParent[ $key ]->Program );
			}
		}

		return $this;
	}

	/**
	 * Check if all have registration dates.
	 *
	 * @param $events
	 *   Events.
	 *
	 * @return bool
	 *   TRUE or FALSE.
	 */
	public function registrationStatusDates( $events ) {
		$allEvents = [];
		if ( isset( $events ) ) {
			foreach ( $events as $event ) {
				if ( isset( $event->RegistrationDateTime ) ) {
					array_push( $allEvents, true );
				} else {
					array_push( $allEvents, false );
				}
			}
			if ( count( array_unique( $allEvents ) ) === 1 ) {
				return current( $allEvents );
			}
		}

		return null;
	}

	/**
	 * Check if all events are full.
	 *
	 * @param $events
	 *   Events.
	 *
	 * @return bool
	 *   TRUE or FALSE.
	 */
	public function registrationStatusRegistrationFull( $events ) {
		$allEvents = [];
		if ( isset( $events ) ) {
			foreach ( $events as $event ) {
				if ( $event->CurrentParticipants < $event->ParticipantMaximum ) {
					array_push( $allEvents, false );
				} else {
					array_push( $allEvents, true );
				}
			}
			if ( count( array_unique( $allEvents ) ) === 1 ) {
				return current( $allEvents );
			}
		}

		return null;
	}

	/**
	 * Check if events are planned.
	 *
	 * @param $events
	 *   Events.
	 *
	 * @return bool
	 *   TRUE or FALSE.
	 */
	public function registrationStatusAllEventsPlanned( $events ) {
		$allEvents = [];
		if ( isset( $events ) ) {
			foreach ( $events as $event ) {
				$time = time();
				if ( $time < strtotime( $event->RegistrationDateTime ) && isset( $event->RegistrationDateTime ) ) {
					array_push( $allEvents, true );
				} else {
					array_push( $allEvents, false );
				}
			}
			if ( count( array_unique( $allEvents ) ) === 1 ) {
				return current( $allEvents );
			}
		}

		return null;
	}

}
