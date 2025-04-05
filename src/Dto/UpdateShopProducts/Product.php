<?php

declare(strict_types=1);

namespace AfterbuySdk\Dto\UpdateShopProducts;

use AfterbuySdk\Enum\AgeGroupEnum;
use AfterbuySdk\Enum\ConditionEnum;
use AfterbuySdk\Enum\EnergyClassEnum;
use AfterbuySdk\Enum\GenderEnum;
use AfterbuySdk\Enum\UnitOfQuantityEnum;
use AfterbuySdk\Extends\SimpleXMLExtend;
use AfterbuySdk\Interface\AfterbuyAppendXmlContentInterface;

final readonly class Product implements AfterbuyAppendXmlContentInterface
{
    /**
     * @param string[] $tags
     * @param Variation[] $useEbayVariations
     * @param PartsProperty[][] $partsFitment
     * @param AdditionalPriceUpdate[] $additionalPriceUpdates
     * @param ProductPicture[] $productPictures
     * @param AdditionalDescriptionField[] $additionalDescriptionFields
     * @param Feature[] $features
     */
    public function __construct(
        private string $name,
        private ?ProductIdent $productIdent = null,
        private ?int $anr = null,
        private ?string $ean = null,
        private ?int $headerId = null,
        private ?int $footerId = null,
        private ?string $manufacturerPartNumber = null,
        private ?string $shortDescription = null,
        private ?string $memo = null,
        private ?string $description = null,
        private ?string $keywords = null,
        private ?int $quantity = null,
        private ?int $auctionQuantity = null,
        private ?int $addQuantity = null,
        private ?int $addAuctionQuantity = null,
        private ?bool $stock = null,
        private ?bool $discontinued = null,
        private ?bool $mergeStock = null,
        private ?UnitOfQuantityEnum $unitOfQuantityEnum = null,
        private ?string $basepriceFactor = null,
        private ?int $minimumStock = null,
        private ?float $sellingPrice = null,
        private ?float $buyingPrice = null,
        private ?float $dealerPrice = null,
        private ?int $level = null,
        private ?int $position = null,
        private ?bool $titleReplace = null,
        private ?ScaledDiscount $scaledDiscount = null,
        private ?float $taxRate = null,
        private ?float $weight = null,
        private ?string $stocklocation_1 = null,
        private ?string $stocklocation_2 = null,
        private ?string $stocklocation_3 = null,
        private ?string $stocklocation_4 = null,
        private ?string $countryOfOrigin = null,
        private ?string $searchAlias = null,
        private ?bool $froogle = null,
        private ?bool $kelkoo = null,
        private ?string $shippingGroup = null,
        private ?string $shopShippingGroup = null,
        private ?int $crossCatalogId = null,
        private ?string $freeValue1 = null,
        private ?string $freeValue2 = null,
        private ?string $freeValue3 = null,
        private ?string $freeValue4 = null,
        private ?string $freeValue5 = null,
        private ?string $freeValue6 = null,
        private ?string $freeValue7 = null,
        private ?string $freeValue8 = null,
        private ?string $freeValue9 = null,
        private ?string $freeValue10 = null,
        private ?string $deliveryTime = null,
        private ?string $imageSmallUrl = null,
        private ?string $imageLargeUrl = null,
        private ?string $imageName = null,
        private ?string $imageSource = null,
        private ?string $manufacturerStandardProductIdType = null,
        private ?string $manufacturerStandardProductIdValue = null,
        private ?string $productBrand = null,
        private ?string $customsTariffNumber = null,
        private ?string $googleProductCategory = null,
        private ?ConditionEnum $conditionEnum = null,
        private ?string $pattern = null,
        private ?string $material = null,
        private ?string $itemColor = null,
        private ?string $itemSize = null,
        private ?string $canonicalUrl = null,
        private ?EnergyClassEnum $energyClassEnum = null,
        private ?string $energyClassPictureUrl = null,
        private ?string $dataSheetUrl = null,
        private ?GenderEnum $genderEnum = null,
        private ?AgeGroupEnum $ageGroupEnum = null,
        private ?Economicoperators $economicoperators = null,
        private array $tags = [],
        private array $useEbayVariations = [],
        private array $partsFitment = [],
        private array $additionalPriceUpdates = [],
        private array $productPictures = [],
        private array $additionalDescriptionFields = [],
        private array $features = [],
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $xml): void
    {
        $product = $xml->addChild('Product');
        $product->addString('Name', $this->name);
        $this->productIdent?->appendXmlContent($product);
        $product->addNumber('Anr', $this->anr);
        $product->addString('EAN', $this->ean);
        $product->addNumber('HeaderID', $this->headerId);
        $product->addNumber('FooterID', $this->footerId);
        $product->addString('ManufacturerPartNumber', $this->manufacturerPartNumber);
        $product->addString('ShortDescription', $this->shortDescription);
        $product->addString('Memo', $this->memo);
        $product->addString('Description', $this->description);
        $product->addString('Keywords', $this->keywords);
        $product->addNumber('Quantity', $this->quantity);
        $product->addNumber('AuctionQuantity', $this->auctionQuantity);
        $product->addNumber('AddQuantity', $this->addQuantity);
        $product->addNumber('AddAuctionQuantity', $this->addAuctionQuantity);
        $product->addBool('Stock', $this->stock);
        $product->addBool('Discontinued', $this->discontinued);
        $product->addBool('MergeStock', $this->mergeStock);
        $product->addString('UnitOfQuantity', $this->unitOfQuantityEnum?->value);
        $product->addString('BasePriceFactor', $this->basepriceFactor);
        $product->addNumber('MinimumStock', $this->minimumStock);
        $product->addNumber('SellingPrice', $this->sellingPrice);
        $product->addNumber('BuyingPrice', $this->buyingPrice);
        $product->addNumber('DealerPrice', $this->dealerPrice);
        $product->addNumber('Level', $this->level);
        $product->addNumber('Position', $this->position);
        $product->addBool('TitleReplace', $this->titleReplace);
        $this->scaledDiscount?->appendXmlContent($product);
        $product->addNumber('TaxRate', $this->taxRate);
        $product->addNumber('Weight', $this->weight);
        $product->addString('Stocklocation_1', $this->stocklocation_1);
        $product->addString('Stocklocation_2', $this->stocklocation_2);
        $product->addString('Stocklocation_3', $this->stocklocation_3);
        $product->addString('Stocklocation_4', $this->stocklocation_4);
        $product->addString('CountryOfOrigin', $this->countryOfOrigin);
        $product->addString('SearchAlias', $this->searchAlias);
        $product->addBool('Froogle', $this->froogle);
        $product->addBool('Kelkoo', $this->kelkoo);
        $product->addString('ShippingGroup', $this->shippingGroup);
        $product->addString('ShopShippingGroup', $this->shopShippingGroup);
        $product->addNumber('CrossCatalogID', $this->crossCatalogId);
        $product->addString('FreeValue1', $this->freeValue1);
        $product->addString('FreeValue2', $this->freeValue2);
        $product->addString('FreeValue3', $this->freeValue3);
        $product->addString('FreeValue4', $this->freeValue4);
        $product->addString('FreeValue5', $this->freeValue5);
        $product->addString('FreeValue6', $this->freeValue6);
        $product->addString('FreeValue7', $this->freeValue7);
        $product->addString('FreeValue8', $this->freeValue8);
        $product->addString('FreeValue9', $this->freeValue9);
        $product->addString('FreeValue10', $this->freeValue10);
        $product->addString('DeliveryTime', $this->deliveryTime);
        $product->addString('ImageSmallURL', $this->imageSmallUrl);
        $product->addString('ImageLargeURL', $this->imageLargeUrl);
        $product->addString('ImageName', $this->imageName);
        $product->addString('ImageSource', $this->imageSource);
        $product->addString('ManufacturerStandardProductIDType', $this->manufacturerStandardProductIdType);
        $product->addString('ManufacturerStandardProductIDValue', $this->manufacturerStandardProductIdValue);
        $product->addString('ProductBrand', $this->productBrand);
        $product->addString('CustomsTariffNumber', $this->customsTariffNumber);
        $product->addString('GoogleProductCategory', $this->googleProductCategory);
        $product->addNumber('Condition', $this->conditionEnum?->value);
        $product->addString('Pattern', $this->pattern);
        $product->addString('Material', $this->material);
        $product->addString('ItemColor', $this->itemColor);
        $product->addString('ItemSize', $this->itemSize);
        $product->addString('CanonicalURL', $this->canonicalUrl);
        $product->addNumber('EnergyClass', $this->energyClassEnum?->value);
        $product->addString('EnergyClassPictureURL', $this->energyClassPictureUrl);
        $product->addString('DataSheetURL', $this->dataSheetUrl);
        $product->addNumber('Gender', $this->genderEnum?->value);
        $product->addNumber('AgeGroup', $this->ageGroupEnum?->value);
        $this->economicoperators?->appendXmlContent($product);

        if ($this->tags !== []) {
            $tags = $product->addChild('Tags');
            foreach ($this->tags as $tag) {
                $tags->addString('Tag', $tag);
            }
        }

        if ($this->useEbayVariations !== []) {
            $useEbayVariations = $product->addChild('UseEbayVariations');
            foreach ($this->useEbayVariations as $useEbayVariation) {
                $useEbayVariation->appendXmlContent($useEbayVariations);
            }
        }

        if ($this->partsFitment !== []) {
            $partsFitment = $product->addChild('PartsFitment');
            foreach ($this->partsFitment as $partFitment) {
                if ($partFitment !== []) {
                    $partsProperties = $partsFitment->addChild('PartsProperties');
                    foreach ($partFitment as $partsProperty) {
                        $partsProperty->appendXmlContent($partsProperties);
                    }
                }

            }
        }

        if ($this->additionalPriceUpdates !== []) {
            $additionalPrice = $product->addChild('AdditionalPrice');
            foreach ($this->additionalPriceUpdates as $additionalPriceUpdate) {
                $additionalPriceUpdate->appendXmlContent($additionalPrice);
            }
        }

        if ($this->productPictures !== []) {
            $productPictures = $product->addChild('ProductPictures');
            foreach ($this->productPictures as $productPicture) {
                $productPicture->appendXmlContent($productPictures);
            }
        }

        if ($this->additionalDescriptionFields !== []) {
            $additionalDescriptionFields = $product->addChild('AdditionalDescriptionFields');
            foreach ($this->additionalDescriptionFields as $additionalDescriptionField) {
                $additionalDescriptionField->appendXmlContent($additionalDescriptionFields);
            }
        }

        if ($this->features !== []) {
            $features = $product->addChild('Features');
            foreach ($this->features as $feature) {
                $feature->appendXmlContent($features);
            }
        }
    }
}
