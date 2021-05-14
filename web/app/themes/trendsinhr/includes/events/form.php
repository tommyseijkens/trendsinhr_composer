<form id="event-viewer-subscribe-form" action="<?php echo admin_url('admin-post.php') ?>" method="post" novalidate>
  <?php if (count((array) $detail->EventsForParent) >= 1): ?>
    <div class="form-row">
      <div class="form-group col-12">
        <h5>Datum en locatie</h5>
      </div>
      <div class="form-group col-12">
        <select required="" name="EventId" class="form-control<?php if (count((array) $detail->EventsForParent) == 1) { ?> disabled<?php } ?>" aria-required="true" id="EventId">
          <?php if (count((array) $detail->EventsForParent) > 1): ?>
            <option value="">Maak een keuze...</option><?php endif; ?>
          <?php foreach ($detail->EventsForParent as $event): ?>
            <?php if ($event->CanRegister) : ?>
              <option value='<?php echo $event->Id; ?>'><?php echo ucfirst(strftime("%A %e %B %Y", $event->StartDateTime)); ?><?php if($event->Location != ' '): ?> - <?php echo $event->Location; ?><?php endif; ?></option>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
    </div>
  <?php endif; ?>
  <?php
  foreach ($detail->EventsForParent as $event):
    if ($event->Program) {
      $chooseSessionsTitleDisplayed = FALSE; ?>

      <div class="breakout" data-breakout="<?php echo $event->Id; ?>">
        <?php

        foreach ($event->Program as $value):

          if (!$value->ParentProgramItemId) { ?>

            <?php
            // if ParentProgramItemId is empty then this is a parent item
            $countBreakOutSessions = 0;
            $breakoutSessionId = $value->Id;
            $breakoutSessionTitle = $value->Title;
            foreach ($event->Program as $value):
              if ($value->ParentProgramItemId == $breakoutSessionId) {
                $countBreakOutSessions++;
              }
            endforeach;
            // if $countBreakOutSessions is more than 0 then this is a breakoutsession

            if ($countBreakOutSessions > 0) {
              if (!$chooseSessionsTitleDisplayed) { ?>
                <div class="form-row">
                  <div class="form-group col-12">
                    <h5>Programmakeuze</h5>
                  </div>
                </div>
                <?php
                // display block 'Programmakeuze' only once in case of multiple breakoutsessions
                $chooseSessionsTitleDisplayed = TRUE;
              } ?>
              <div class="form-row event-upnext-breakoutsession-selectbox">
                <div class="form-group col-12">
                  <label class="h6" for="SelectedProgramOptions"><?php echo $breakoutSessionTitle; ?></label>
                  <select disabled="disabled" required="" name="SelectedProgramOptions[]" class="form-control" aria-required="true" id="SelectedProgramOptions">
                    <option value="">Maak een keuze...</option>
                    <?php
                    // loop through all child elements of the main breakout session
                    foreach ($event->Program as $value):
                      if ($value->ParentProgramItemId == $breakoutSessionId) { ?>
                        <option value='<?php echo $value->Id; ?>'><?php echo $value->Title; ?></option>
                      <?php }
                    endforeach; ?>
                  </select>
                </div>
              </div>
            <?php } ?>


          <?php } ?>


        <?php endforeach; ?>
      </div>
    <?php } endforeach; ?>


  <div class="form-row">
    <div class="form-group col-12">
      <h5>Persoonsgegevens</h5>
    </div>
    <div class="form-group col-sm-4">
      <select required name="Person[GenderId]" class="form-control">
        <option value="">Aanhef*</option>
        <option value="1">Dhr.</option>
        <option value="2">Mevr.</option>
      </select>
    </div>
    <div class="form-group col-sm-4">
      <input required name="Person[FirstName]" autocomplete="given-name"
             class="form-control" type="text"
             value="<?php if (isset($form->Person->FirstName)) {
               echo $form->Person->FirstName;
             } ?>" placeholder="Voornaam*">
    </div>
    <div class="form-group col-sm-4">
      <input required name="Person[LastName]" autocomplete="family-name"
             class="form-control" type="text"
             value="<?php if (isset($form->Person->LastName)) {
               echo $form->Person->LastName;
             } ?>" placeholder="Achternaam*">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-sm-6">
      <input required name="Organisation[Name]" autocomplete="organisation"
             class="form-control" type="text"
             value="<?php if (isset($form->Organisation->Name)) {
               echo $form->Organisation->Name;
             } ?>" placeholder="Organisatie*">
    </div>
    <div class="form-group col-sm-6">
      <input name="Person[Occupation]" class="form-control" type="text"
             value="<?php if (isset($form->Person->Occupation)) {
               echo $form->Person->Occupation;
             } ?>" placeholder="Functie">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-sm-6">
      <input required name="Person[EmailAddress]" autocomplete="email"
             class="form-control" type="email"
             value="<?php if (isset($form->Person->EmailAddress)) {
               echo $form->Person->EmailAddress;
             } ?>" placeholder="E-mailadres*">
    </div>
    <div class="form-group col-sm-6">
      <input name="Organisation[PhoneNumber]" autocomplete="tel"
             class="form-control" type="text"
             value="<?php if (isset($form->Organisation->PhoneNumber)) {
               echo $form->Organisation->PhoneNumber;
             } ?>" placeholder="Telefoonnummer">
    </div>
  </div>

  <div class="form-row">
    <div class="form-group col-sm-12">
      <h5>Opmerkingen</h5>
    </div>
    <div class="form-group col-sm-12">
      <textarea rows="4" name="Remarks" class="form-control" type="text" placeholder="Geef hier eventuele opmerkingen"><?php if (isset($form->Remarks)) {
          echo $form->Remarks;
        } ?></textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="col-sm-12">
      <div class="form-group form-check">
        <input required name="AgreesWithChannelTermsAndConditions"
               class="form-check-input" type="checkbox" value="true"
               id="checkbox_av">
        <label class="form-check-label"
               for="checkbox_av"><?php echo get_option('subscribe_form_checkbox_av'); ?></label>
      </div>
    </div>
  </div>
  <input type="hidden" name="Id" value="-1">
  <input type="hidden" name="action" value="register_event_person">
  <?php wp_nonce_field('register_event_person', '_mynonce'); ?>
  <input type="submit" value="Inschrijving verzenden" class="btn btn-primary">
</form>
