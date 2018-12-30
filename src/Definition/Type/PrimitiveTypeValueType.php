<?php

namespace DCarbone\PHPFHIR\Definition\Type;

/*
 * Copyright 2016-2018 Daniel Carbone (daniel.p.carbone@gmail.com)
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

use DCarbone\PHPFHIR\Definition\Type\AbstractType;

/**
 * This is a placeholder type to be used when attempting to assign a type to a primitive property, such as
 * "string-primitive"
 *
 * Class PrimitiveTypeValueType
 * @package DCarbone\PHPFHIR\Definition\Type
 */
class PrimitiveTypeValueType extends AbstractType
{
    /**
     * @return bool
     */
    public function isPrimitive()
    {
        return true;
    }

    /**
     * @return bool
     */
    public function isUndefined()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isHTML()
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPrimitiveTypeValueType()
    {
        return false;
    }
}