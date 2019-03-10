<?php

/*
 * Copyright 2016-2019 Daniel Carbone (daniel.p.carbone@gmail.com)
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

use DCarbone\PHPFHIR\Enum\TypeKindEnum;

/** @var \DCarbone\PHPFHIR\Definition\Type $type */
/** @var \DCarbone\PHPFHIR\Enum\TypeKindEnum $typeKind */

ob_start();
if ($typeKind->isPrimitive()) :
    echo require PHPFHIR_TEMPLATE_SERIALIZATION_DIR . '/json/primitive.php';
elseif ($typeKind->isList()) :
    echo require PHPFHIR_TEMPLATE_SERIALIZATION_DIR . '/json/list.php';
elseif ($typeKind->isPrimitiveContainer()) :
    echo require PHPFHIR_TEMPLATE_SERIALIZATION_DIR . '/json/primitive_container.php';
elseif ($typeKind->isOneOf([TypeKindEnum::RESOURCE_CONTAINER, TypeKindEnum::RESOURCE_INLINE])) :

else:

endif;
return ob_get_clean();