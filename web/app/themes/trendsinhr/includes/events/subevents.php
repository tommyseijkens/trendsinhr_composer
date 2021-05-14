<?php if ($detail->EventsForParent): ?>
  <h2>Programma</h2>
  <table class="program-list">

    <?php foreach ($detail->EventsForParent as $event): ?>
      <tr class="program-list__row">
        <td nowrap class="program-list__item">
          <?php echo strftime("%a %e %B", $event->StartDateTime); ?>
        </td>
        <?php if (!empty($event->Location) && get_option('extension_show_location')): ?>
          <td nowrap class="program-list__item">
            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="13" viewBox="0 0 12 13">
              <path fill="#1D1D1D"
                    d="M7.76566837,12.2460938 C8.00264873,12.0091134 8.12113713,11.7213559 8.12113713,11.3828125 C8.12113713,11.0442691 8.00688046,10.7607433 7.77836369,10.5322266 C7.54984692,10.3037098 7.26632111,10.1894531 6.92777775,10.1894531 C6.58923439,10.1894531 6.30570858,10.3037098 6.07719181,10.5322266 C5.84867504,10.7607433 5.73441837,11.0442691 5.73441837,11.3828125 C5.73441837,11.7213559 5.84867504,12.0048817 6.07719181,12.2333984 C6.30570858,12.4619152 6.58923439,12.5761719 6.92777775,12.5761719 C7.26632111,12.5761719 7.54561519,12.4661469 7.76566837,12.2460938 Z M10.7363715,7.57421875 C11.7858559,8.62370316 12.3105903,9.89322172 12.3105903,11.3828125 C12.3105903,12.8724033 11.7858559,14.1419218 10.7363715,15.1914062 L6.92777775,19 L3.119184,15.1914062 C2.06969959,14.1419218 1.54496525,12.8724033 1.54496525,11.3828125 C1.54496525,9.89322172 2.06969959,8.62370316 3.119184,7.57421875 C4.16866841,6.52473434 5.43818697,6 6.92777775,6 C8.41736853,6 9.68688709,6.52473434 10.7363715,7.57421875 Z"
                    transform="translate(-1 -6)"/>
            </svg>
            <?php if (!empty($event->Detail->LocationRendered->Street)): ?>
            <a class="popup-modal" href="#modal-event-<?php echo $event->Id; ?>-location">
              <?php endif; ?>
                <?php echo $event->Location; ?>
              <?php if (!empty($event->Detail->LocationRendered->Street)): ?>
            </a>
          <?php endif; ?>
          </td>
        <?php endif; ?>
        <td nowrap class="program-list__item">
          <?php if (!empty($event->Program)): ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 13 13">
              <path fill="#1D1D1D"
                    d="M1.90429688,7.9296875 C3.17383447,6.6601499 4.7057202,6.02539062 6.5,6.02539062 C8.2942798,6.02539062 9.8219338,6.65591817 11.0830078,7.91699219 C12.3440818,9.1780662 12.9746094,10.7057202 12.9746094,12.5 C12.9746094,14.2942798 12.3440818,15.8261655 11.0830078,17.0957031 C9.8219338,18.3652407 8.2942798,19 6.5,19 C4.7057202,19 3.17383447,18.3652407 1.90429688,17.0957031 C0.634759277,15.8261655 0,14.2942798 0,12.5 C0,10.7057202 0.634759277,9.18229793 1.90429688,7.9296875 Z M7.03320312,12.3222656 L7.03320312,8.89453125 L5.94140625,8.89453125 L5.94140625,13.4140625 L9.72460938,13.4140625 L9.72460938,12.3222656 L7.03320312,12.3222656 Z"
                    transform="translate(0 -6)"/>
            </svg>
            <a class="popup-modal" href="#modal-event-<?php echo $event->Id; ?>-program">
              Bekijk programma
            </a>
          <?php endif; ?>
        </td>
        <td nowrap class="program-list__item">
          <?php if ($event->CurrentParticipants >= $event->ParticipantMaximum && get_option('extension_spare_list')): ?>
            <svg xmlns="http://www.w3.org/2000/svg" width="11" height="13" viewBox="0 0 11 13">
              <path fill="#1D1D1D"
                    d="M4.46875,6.86328125 C5.02734654,6.30468471 5.70442311,6.02539062 6.5,6.02539062 C7.29557689,6.02539062 7.97265346,6.30468471 8.53125,6.86328125 C9.08984654,7.42187779 9.36914062,8.09895436 9.36914062,8.89453125 C9.36914062,9.69010814 9.08984654,10.3714164 8.53125,10.9384766 C7.97265346,11.5055367 7.29557689,11.7890625 6.5,11.7890625 C5.70442311,11.7890625 5.02734654,11.5055367 4.46875,10.9384766 C3.91015346,10.3714164 3.63085938,9.69010814 3.63085938,8.89453125 C3.63085938,8.09895436 3.91015346,7.42187779 4.46875,6.86328125 Z M4.3671875,13.2363281 L8.6328125,13.2363281 C9.42838939,13.2363281 10.1139294,13.5240857 10.6894531,14.0996094 C11.2649768,14.6751331 11.5527344,15.3606731 11.5527344,16.15625 L11.5527344,19 L1.44726562,19 L1.44726562,16.15625 C1.44726562,15.3606731 1.73502316,14.6751331 2.31054688,14.0996094 C2.88607059,13.5240857 3.57161061,13.2363281 4.3671875,13.2363281 Z"
                    transform="translate(-1 -6)"/>
            </svg>
            <a target="_blank" href="<?php echo get_option('extension_spare_list_link'); ?>?ename=<?php echo $event->Name; ?>&eid=<?php echo $event->Id; ?>&edate=<?php echo strftime("%A %e %B %Y", $event->StartDateTime); ?>">
              Reservelijst
            </a>
          <?php endif; ?>
        </td>
        <td nowrap class="program-list__item">
          <?php if ($event->CurrentParticipants >= $event->ParticipantMaximum): ?>
            <div class="program-item__full">vol</div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
  <?php foreach ($detail->EventsForParent as $event): ?>
    <?php if (!empty($event->Detail->LocationRendered->Street)): ?>
      <div id="modal-event-<?php echo $event->Id; ?>-location" class="modal-event-popup modal-event-popup-location white-popup-block event-upnext mfp-hide">
        <section class="modal-event-popup-header">
          <div class="row-flex mb-4">
            <div class="col-12 col-sm-5">
              <h2>Locatie</h2>
              <p>
              <?php //$event->LocationRendered = $this->request('GET', 'Location/LocationDetails/' . $event->LocationId, ''); ?>
              <?php echo $event->Detail->LocationRendered->Name; ?><br/>
              <?php echo $event->Detail->LocationRendered->Street; ?> <?php echo $event->Detail->LocationRendered->HouseNumber; ?> <?php echo $event->Detail->LocationRendered->HouseNumberSuffix; ?><br/>
              <?php echo $event->Detail->LocationRendered->ZipCode; ?> <?php echo $event->Detail->LocationRendered->City; ?><br/>
              </p>
            </div>
            <div class="col-12 col-sm-7">
              <iframe src="https://www.google.com/maps/embed/v1/place?q=<?php echo $event->Detail->LocationRendered->Street . '%20' . $event->Detail->LocationRendered->HouseNumber . '%20' . $event->Detail->LocationRendered->City; ?>&key=<?php echo get_option('google_api_maps_embed'); ?>">

              </iframe>
            </div>
          </div>
        </section>
      </div>
    <?php endif; ?>
    <?php if (!empty($event->Program)): ?>
      <div id="modal-event-<?php echo $event->Id; ?>-program" class="modal-event-popup white-popup-block event-upnext mfp-hide">
        <section class="modal-event-popup-header">
          <div class="row mb-4">
            <div class="col">
              <?php if (!empty($event->Program)): ?>
                <h2>Programma</h2>
                <div class="program">
                  <?php foreach ($event->Program as $value): ?>
                    <?php
                    $infoArray = [];
                    if (isset($value->Room)) {
                      array_push($infoArray, $value->Room);
                    }
                    if (isset($value->LocationRendered->City)) {
                      array_push($infoArray, $value->LocationRendered->City);
                    }
                    if ($event->DifferentDatesProgram) {
                      array_push($infoArray, date("D d-m-Y", $value->EndDateTime));
                    } ?>
                    <div class="program-item">
                      <div class="program-item-info d-sm-flex">
                        <div class="program-item-info-date mr-auto"><?php echo date("H.i", $value->StartDateTime); ?> - <?php echo date("H.i", $value->EndDateTime); ?> uur
                        </div>
                        <div class="">
                          <?php foreach ($infoArray as $item): ?>
                            <?php echo $item; ?>
                            <?php if ($item !== end($infoArray)): ?>
                              <span> - </span><?php endif; ?>
                          <?php endforeach; ?>
                        </div>
                      </div>
                      <div class="program-item-title"><?php echo $value->Title; ?></div>
                      <?php if (!empty($value->Description)): ?>
                        <div class="program-item-description"><?php echo $value->Description; ?></div><?php endif; ?>
                    </div>
                  <?php endforeach; ?>
                </div>
              <?php endif; ?>
            </div>
          </div>
        </section>
      </div>
    <?php endif; ?>
  <?php endforeach; ?>
<?php endif; ?>
