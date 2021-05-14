<?php

/**
 * @file
 * UpNext public functions.
 */

$upnext = new Upnext_Public('upnext', '1.1.0');

// Get Events.
$eventConnector = new ConfigApi();
$eventConnector = $eventConnector->connect();
$events = $eventConnector->requestEvents()->parseEventsLinkToParent()->parseEventsDuration()->parseEventsImages()->getEvents();

// Init arrays.
$array_months = array();
$array_locations = array();

foreach ($events as $event) :

    // Get all months.
    $date = $event->StartDateTime;
    $month = date('Y-m', $date);
    if (!in_array($month . "-01", $array_months)) {
        $array_months[] = $month . "-01";
    }

    // Get event locations
    $location = $event->Location;
    if (!in_array($location, $array_locations) && !empty($event->Location) && $event->DisplayLocation && $event->Location != ' ') {
        $array_locations[] = $location;
    }

endforeach;

// create a new container with label for every month
foreach ($array_months as $key => $value) { ?>
    <div class="container grid-section-label d-md-block position-relative"><?php echo strftime('%b \'%y', strtotime($value)); ?></div>
    <div class="container event-container">
        <div class="list-overview">
            <div class="row">
                <div class="col-12 col-lg-8 col-xl-6 m-auto">
                    <div class="grid-overview">

                        <?php
                        foreach ($events as $event) :
                            if (empty($event->Location) || !$event->DisplayLocation || $event->Location == ' ') {
                                $event->Location = '';
                            }
                            $currentMY = date('m', strtotime($value)) . date('y', strtotime($value));
                            $eventMY = strftime("%m", $event->StartDateTime) . strftime("%y", $event->StartDateTime);

                            if ($currentMY == $eventMY) { ?>

                                <div class="card-item card-item--event">
                                    <a class="card-item__content" href="<?php echo get_site_url().$upnext->getDetailLink($event); ?>">
                                        <?php /*
                                        <div class="card-item__background"
                                             style="background-image: url('data:image/jpg;base64,<?php echo $event->HeaderRendered; ?>');"></div>
                                         */ ?>
                                        <div class="card-item__background"></div>
                                        <div class="card-item__description">
                                            <div class="labels">
                                                <span class="label card-item__label card-item__label--longdate"><?php echo strftime("%A %e %B %Y", $event->StartDateTime); ?></span>
                                                <span class="label card-item__label card-item__label--shortdate"><?php echo strftime("%a %e %b '%y", $event->StartDateTime); ?></span>
                                                <span class="label card-item__label card-item__label--company"><?php echo $event->BusinessUnit; ?></span>
                                            </div>
                                            <span class="card-item__title"><?php echo $event->Name; ?></span>
                                        </div>
                                    </a>
                                </div>

                            <?php
                            }
                        endforeach; ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>










