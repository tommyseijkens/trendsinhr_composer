<?php

namespace NF_FU_VENDOR;

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */
class Google_Service_DriveActivity_KnownUser extends \NF_FU_VENDOR\Google_Model
{
    public $isCurrentUser;
    public $personName;
    public function setIsCurrentUser($isCurrentUser)
    {
        $this->isCurrentUser = $isCurrentUser;
    }
    public function getIsCurrentUser()
    {
        return $this->isCurrentUser;
    }
    public function setPersonName($personName)
    {
        $this->personName = $personName;
    }
    public function getPersonName()
    {
        return $this->personName;
    }
}
