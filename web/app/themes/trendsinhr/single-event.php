<?php get_header(); ?>
<?php include('includes/parts/header-top.php'); ?>
<?php include('includes/navigation/main-navigation.php'); ?>

<?php
// Public functions UpNext.
$upnext = new Upnext_Public('upnext', '1.1.0');
$upnext->initDetail();

// Event functions.
$eventConnector = new ConfigApi();
$eventConnector = $eventConnector->connect();
$eventConnector->setDetailId($upnext->eventIdUrl);
$eventConnector->detail()->programForEvents();

$events = $eventConnector->requestEvents()->parseEventsLinkToParent()->parseEventsDuration()->getEvents();

// Detail.
$detail = $eventConnector->detail;
$upnext->setDetail($detail);

if (isset($detail->EventsForParent)) {
    foreach ($detail->EventsForParent as $event) {
        $event->Detail = $eventConnector->request('GET', 'Event/EventDetails/' . $event->Id);
        $event->Detail->LocationRendered = $eventConnector->request('GET', 'Location/LocationDetails/' . $event->Detail->LocationId);
    }
}

// Get additional events.
$detail->RegistrationStatusRegistrationFull = $eventConnector->registrationStatusRegistrationFull($detail->EventsForParent);
$detail->RegistrationStatusDates = $eventConnector->registrationStatusDates($detail->EventsForParent);
$detail->RegistrationStatusEventsPlanned = $eventConnector->registrationStatusAllEventsPlanned($detail->EventsForParent);

$color = 'theme-bg-01';
$unit = strtolower($event->BusinessUnit);
switch ($unit) {
    case 'ijk':
        $color = 'theme-bg-02'; // groen
        break;
    case 'driessen':
        $color = 'theme-bg-03'; // rood
        break;
    case 'mensium':
        $color = 'theme-bg-04'; // paars
        break;
    case 'jeij':
        $color = 'theme-bg-05'; // blauw
        break;
}

?>


<div class="page page--event">

    <div class="page-header page-header--column <?php echo $color; ?> page-header__eventimage position-relative"
         style="background-image:url(data:image/jpg;base64,<?php echo $detail->HeaderRendered; ?>);">
        <div class="page-header--fadebg"></div>
        <div class="container d-flex flex-column justify-content-end h-100">
            <div class="row">
                <div class="container-content align-self-end">
                    <div>
                        <div class="labels">
                            <div class="label">Een event van <?php echo $event->BusinessUnit; ?></div>
                        </div>
                        <h1 class="display-2"><?php echo $event->Name; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-7">
        <div class="row">
            <div class="container-content the-content">
                <!-- Description -->
                <?php if (!empty($detail->Description)) : ?>
                    <?php echo $detail->Description; ?>
                <?php endif; ?>

                <!-- UserTarget -->
                <?php if ($detail->DisplayUserTarget && !empty($detail->UserTarget)): ?>
                    <h2>Doelgroep</h2>
                    <p><?php echo $detail->UserTarget; ?></p>
                <?php endif; ?>

                <!-- Method -->
                <?php if ($detail->DisplayMethod && !empty($detail->Method)): ?>
                    <h2>Methode</h2>
                    <p><?php echo $detail->Method->Description; ?></p>
                <?php endif; ?>

                <!-- Location -->
                <?php if (!empty($detail->LocationRendered) && $detail->DisplayLocation && !empty($detail->ParentId)): ?>
                    <h2>Locatie</h2>
                    <p>
                    <?php echo $detail->LocationRendered->Name; ?> <br/>
                    <?php if (!empty($detail->LocationRendered->Street)): ?>
                        <?php echo $detail->LocationRendered->Street; ?><?php echo $detail->LocationRendered->HouseNumber; ?>
                        <?php if (!empty($detail->LocationRendered->HouseNumberSuffix)): ?><?php echo $detail->LocationRendered->HouseNumberSuffix; ?><?php endif; ?>
                        <br/><?php echo $detail->LocationRendered->ZipCode; ?><?php echo $detail->LocationRendered->City; ?>
                        </p>
                    <?php endif; ?>
                <?php endif; ?>

                <!-- Price -->
                <?php if ($detail->DisplayPrice && !empty($detail->Price)): ?>
                    <h2>Prijs</h2>
                    <p>€ <?php echo $detail->Price; ?> <?php echo $detail->PriceLabel; ?></p>
                <?php endif; ?>

                <!-- Subevents -->
                <?php include('includes/events/subevents.php'); ?>

                <!-- ExtraDescription -->
                <?php if (!empty($detail->ExtraDescription)): ?>
                    <?php echo $detail->ExtraDescription; ?>
                <?php endif; ?>

                <!-- Line -->
                <?php if ($detail->RegistrationStatusDates): ?>
                    <hr style="margin-top: 40px; margin-bottom: 40px;"/>
                <?php endif; ?>

                <!-- Registration full -->
                <?php if ($detail->RegistrationStatusRegistrationFull): ?>
                    <?php echo $upnext->getText('registration_full'); ?>
                <?php elseif ($detail->RegistrationStatusEventsPlanned): ?>
                    <?php echo $upnext->getText('invitation_text'); ?>
                <?php elseif ($detail->RegistrationStatusDates && $detail->EventsForParentCanRegister): ?>
                    <?php echo $upnext->get_subscribe_form_text($detail->BusinessUnitId); ?>
                    <?php include('includes/events/form.php'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>


</div>

<?php get_footer(); ?>
