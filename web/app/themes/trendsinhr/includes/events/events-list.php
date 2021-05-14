<?php

/**
 * @file
 * UpNext public functions.
 */

$upnext = new Upnext_Public('upnext', '1.1.0');

// Get Events.
$eventConnector = new ConfigApi();
$eventConnector = $eventConnector->connect();
$events = $eventConnector->requestEvents()->parseEventsLinkToParent()->parseEventsDuration()->getEvents();

// Init arrays.
$array_months = array();
$array_locations = array();
?>

<div class="grid-section grid-section--events">
    <div class="grid-section-label d-block">Events</div>
    <div class="cards-row">

        <?php foreach ($events as $event) :
            // Months.
            $date = $event->StartDateTime;
            $month = date('Y-m', $date);
            if (!in_array($month . "-01", $array_months)) {
                $array_months[] = $month . "-01";
            }
            // Locations.
            $location = $event->Location;
            if (!in_array($location, $array_locations) && !empty($event->Location) && $event->DisplayLocation && $event->Location != ' ') {
                $array_locations[] = $location;
            }

            if (empty($event->Location) || !$event->DisplayLocation || $event->Location == ' ') {
                $event->Location = '';
            }

            $title = hyphenate_text( $event->Name, 14);
            ?>

            <div class="card-item card-item--event">
                <a class="card-item__content" href="<?php echo get_site_url().$upnext->getDetailLink($event); ?>">
                    <div class="card-item__background" style="background-image: url('');"></div>
                    <div class="card-item__description">
                        <div class="labels">
                            <span class="label card-item__label card-item__label--longdate"><?php echo strftime("%a %e %b", $event->StartDateTime); ?></span>
                            <span class="label card-item__label card-item__label--shortdate"><?php echo strftime("%a %e %b", $event->StartDateTime); ?></span>
                            <span class="label card-item__label card-item__label--company"><?php echo $event->BusinessUnit; ?></span>
                        </div>
                        <span class="card-item__title"><?php echo $title; ?></span>
                    </div>
                </a>
            </div>

        <?php endforeach; ?>

    </div>
    <div class="cards-row__navigator">
        <div class="cards-row__navigator-left"></div>
        <div class="cards-row__navigator-right active"></div>
    </div>
    <div class="more-link__wrapper">
        <div class="more-link more--events"><a href="<?php echo get_site_url().'/events'; ?>">Alle events</a></div>
    </div>
</div>


