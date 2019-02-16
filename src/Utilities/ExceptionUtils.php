<?php

namespace DCarbone\PHPFHIR\Utilities;

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

use DCarbone\PHPFHIR\Definition\Property;
use DCarbone\PHPFHIR\Definition\Type;

/**
 * Class ExceptionUtils
 * @package DCarbone\PHPFHIR\Utilities
 */
abstract class ExceptionUtils
{
    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @return \DomainException
     */
    public static function createInvalidTypeClassNameException(Type $type)
    {
        return new \DomainException(sprintf(
            'Type "%s" has invalid class name "%s"',
            $type->getFHIRName(),
            $type->getFullyQualifiedClassName(true)
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @return \DomainException
     */
    public static function createInvalidTypeNamespaceException(Type $type)
    {
        return new \DomainException(sprintf(
            'Type "%s" has invalid namespace "%s"',
            $type->getFHIRName(),
            $type->getFullyQualifiedNamespace(true)
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \DCarbone\PHPFHIR\Definition\Property $property
     * @return \DomainException
     */
    public static function createUnknownPropertyTypeException(Type $type, Property $property)
    {
        return new \DomainException(sprintf(
            'Unable to locate Type "%s" for Property "%s" on Type "%s"',
            $property->getValueFHIRTypeName(),
            $property,
            $type->getFHIRName()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @return \DomainException
     */
    public static function createComponentParentTypeNotFoundException(Type $type)
    {
        return new \DomainException(sprintf(
            'Type "%s" is a component of undefined type "%s"',
            $type->getFHIRName(),
            $type->getComponentOfTypeName()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \DCarbone\PHPFHIR\Definition\Property $property
     * @return \DomainException
     */
    public static function createPropertyHasNoNameException(Type $type, Property $property)
    {
        return new \DomainException(sprintf(
            'Type "%s" has property without name: %s',
            $type->getFHIRName(),
            $property->getSourceSXE()->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @return \DomainException
     */
    public static function createTypeParentNotFoundException(Type $type)
    {
        return new \DomainException(sprintf(
            'Unable to locate parent type "%s" for type "%s" from file "%s"',
            $type->getParentTypeName(),
            $type->getFHIRName(),
            $type->getSourceFileBasename()
        ));
    }

    /**
     * @param \SimpleXMLElement $element
     * @param string $sourceFile
     * @return \UnexpectedValueException
     */
    public static function createUnexpectedRootElementException(\SimpleXMLElement $element, $sourceFile)
    {
        return new \UnexpectedValueException(sprintf(
            'Unexpected root element "%s" in file "%s": %s',
            $element->getName(),
            $sourceFile,
            $element->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \SimpleXMLElement $parentElement
     * @param \SimpleXMLElement $attribute
     * @return \UnexpectedValueException
     */
    public static function createUnexpectedAttributeException(Type $type,
                                                              \SimpleXMLElement $parentElement,
                                                              \SimpleXMLElement $attribute)
    {
        return new \UnexpectedValueException(sprintf(
            'Unexpected attribute "%s" on element "%s" in type "%s" defined in file "%s": %s',
            $attribute->getName(),
            $parentElement->getName(),
            $type->getFHIRName(),
            $type->getSourceFileBasename(),
            (string)$attribute
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \SimpleXMLElement $parentElement
     * @param \SimpleXMLElement $element
     * @return \UnexpectedValueException
     */
    public static function createUnexpectedElementException(Type $type,
                                                            \SimpleXMLElement $parentElement,
                                                            \SimpleXMLElement $element)
    {
        return new \UnexpectedValueException(sprintf(
            'Unexpected element "%s" under element "%s" found in type "%s" defined in file "%s": %s',
            $element->getName(),
            $parentElement->getName(),
            $type->getFHIRName(),
            $type->getSourceFileBasename(),
            $element->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \SimpleXMLElement $element
     * @param $attributeName
     * @return \DomainException
     */
    public static function createExpectedTypeElementAttributeNotFoundException(Type $type,
                                                                               \SimpleXMLElement $element,
                                                                               $attributeName)
    {
        return new \DomainException(sprintf(
            'Expected attribute "%s" not found on element "%s" for type "%s" in file "%s": %s',
            $attributeName,
            $element->getName(),
            $type->getFHIRName(),
            $type->getSourceFileBasename(),
            $element->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Property $property
     * @param \SimpleXMLElement $element
     * @param $attributeName
     * @return \DomainException
     */
    public static function createExpectedPropertyElementAttributeNotFoundException(Property $property,
                                                                                   \SimpleXMLElement $element,
                                                                                   $attributeName)
    {
        return new \DomainException(sprintf(
            'Expected attribute "%s" not found on element "%s" for property "%s" in file "%s": %s',
            $attributeName,
            $element->getName(),
            $property->getName(),
            $property->getSourceFileBasename(),
            $element->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param \SimpleXMLElement $parentElement
     * @param \SimpleXMLElement $source
     * @param string $setterMethod
     * @return \BadMethodCallException
     */
    public static function createTypeSetterMethodNotFoundException(Type $type,
                                                                   \SimpleXMLElement $parentElement,
                                                                   \SimpleXMLElement $source,
                                                                   $setterMethod)
    {
        return new \BadMethodCallException(sprintf(
            'Type "%s" from file "%s" missing setter "%s" for "%s" in parent "%s": %s',
            $type->getFHIRName(),
            $type->getSourceFileBasename(),
            $setterMethod,
            $source->getName(),
            $parentElement->getName(),
            $source->saveXML()
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Type $type
     * @param string $parentName
     * @return \UnexpectedValueException
     */
    public static function createExtendingSelfException(Type $type, $parentName)
    {
        return new \UnexpectedValueException(sprintf(
            'Type "%s" in file "%s" has an "extension" element with a "base" attribute value of "%s", indicating it should extend itself?',
            $type->getFHIRName(),
            $type->getSourceFileBasename(),
            $parentName
        ));
    }

    /**
     * @param \DCarbone\PHPFHIR\Definition\Property $property
     * @param \SimpleXMLElement $parentElement
     * @param \SimpleXMLElement $source
     * @param $setterMethod
     * @return \BadMethodCallException
     */
    public static function createPropertySetterMethodNotFoundException(Property $property,
                                                                       \SimpleXMLElement $parentElement,
                                                                       \SimpleXMLElement $source,
                                                                       $setterMethod)
    {
        return new \BadMethodCallException(sprintf(
            'Property "%s" from file "%s" missing setter "%s" for "%s" in parent "%s": %s',
            $property->getName(),
            $property->getSourceFileBasename(),
            $setterMethod,
            $source->getName(),
            $parentElement->getName(),
            $source->saveXML()
        ));
    }
}