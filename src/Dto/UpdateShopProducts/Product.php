<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\UpdateShopProducts;

use Symfony\Component\Validator\Constraints as Assert;
use Wundii\AfterbuySdk\Enum\AgeGroupEnum;
use Wundii\AfterbuySdk\Enum\BasePriceFactorEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\CountryOfOriginEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Enum\GenderEnum;
use Wundii\AfterbuySdk\Extends\SimpleXMLExtend;
use Wundii\AfterbuySdk\Interface\RequestDtoXmlInterface;

final class Product implements RequestDtoXmlInterface
{
    /**
     * @param ScaledDiscount[] $scaledDiscounts
     * @param string[] $tags
     * @param Variation[] $useEbayVariations
     * @param PartsProperties[] $partsFitment
     * @param AdditionalPriceUpdate[] $additionalPriceUpdates
     * @param ProductPicture[] $productPictures
     * @param AdditionalDescriptionField[] $additionalDescriptionFields
     * @param Feature[] $features
     */
    public function __construct(
        private ProductIdent $productIdent,
        private string $name,
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
        private ?float $unitOfQuantity = null,
        private ?BasePriceFactorEnum $basePriceFactorEnum = null,
        private ?int $minimumStock = null,
        private ?float $sellingPrice = null,
        private ?float $buyingPrice = null,
        private ?float $dealerPrice = null,
        private ?int $level = null,
        private ?int $position = null,
        private ?bool $titleReplace = null,
        private array $scaledDiscounts = [],
        private ?float $taxRate = null,
        private ?float $weight = null,
        private ?string $stocklocation_1 = null,
        private ?string $stocklocation_2 = null,
        private ?string $stocklocation_3 = null,
        private ?string $stocklocation_4 = null,
        private ?CountryOfOriginEnum $countryOfOriginEnum = null,
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
        private ?string $imageNameBase64 = null,
        private ?string $imageSourceBase64 = null,
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
        private ?Skus $skus = null,
        private ?AddCatalogs $addCatalogs = null,
        private ?AddAttributes $addAttributes = null,
        private ?AddBaseProducts $addBaseProducts = null,
        private array $useEbayVariations = [],
        private array $partsFitment = [],
        private array $additionalPriceUpdates = [],
        private array $additionalDescriptionFields = [],
        private array $productPictures = [],
        private array $features = [],
    ) {
    }

    public function appendXmlContent(SimpleXMLExtend $simpleXml): void
    {
        $product = $simpleXml->addChild('Product');
        $this->productIdent->appendXmlContent($product);
        $product->addString('Name', $this->name);
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
        $product->addNumber('UnitOfQuantity', $this->unitOfQuantity);
        $product->addString('BasepriceFactor', $this->basePriceFactorEnum?->value);
        $product->addNumber('MinimumStock', $this->minimumStock);
        $product->addNumber('SellingPrice', $this->sellingPrice);
        $product->addNumber('BuyingPrice', $this->buyingPrice);
        $product->addNumber('DealerPrice', $this->dealerPrice);
        $product->addNumber('Level', $this->level);
        $product->addNumber('Position', $this->position);
        $product->addBool('TitleReplace', $this->titleReplace);

        if ($this->scaledDiscounts !== []) {
            $scaledDiscounts = $product->addChild('ScaledDiscounts');
            foreach ($this->scaledDiscounts as $scaledDiscount) {
                $scaledDiscount->appendXmlContent($scaledDiscounts);
            }
        }

        $product->addNumber('TaxRate', $this->taxRate);
        $product->addNumber('Weight', $this->weight);
        $product->addString('Stocklocation_1', $this->stocklocation_1);
        $product->addString('Stocklocation_2', $this->stocklocation_2);
        $product->addString('Stocklocation_3', $this->stocklocation_3);
        $product->addString('Stocklocation_4', $this->stocklocation_4);
        $product->addString('CountryOfOrigin', $this->countryOfOriginEnum?->value);
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
        $product->addString('ImageName', $this->imageNameBase64);
        $product->addString('ImageSource', $this->imageSourceBase64);
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

        $this->skus?->appendXmlContent($product);
        $this->addCatalogs?->appendXmlContent($product);
        $this->addAttributes?->appendXmlContent($product);
        $this->addBaseProducts?->appendXmlContent($product);

        if ($this->useEbayVariations !== []) {
            $useEbayVariations = $product->addChild('UseeBayVariations');
            foreach ($this->useEbayVariations as $useEbayVariation) {
                $useEbayVariation->appendXmlContent($useEbayVariations);
            }
        }

        if ($this->partsFitment !== []) {
            $partsFitment = $product->addChild('PartsFitment');
            foreach ($this->partsFitment as $partFitment) {
                $partFitment->appendXmlContent($partsFitment);
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

    #[Assert\Valid]
    public function getAddAttributes(): ?AddAttributes
    {
        return $this->addAttributes;
    }

    public function setAddAttributes(?AddAttributes $addAttributes): void
    {
        $this->addAttributes = $addAttributes;
    }

    public function getAddAuctionQuantity(): ?int
    {
        return $this->addAuctionQuantity;
    }

    public function setAddAuctionQuantity(?int $addAuctionQuantity): void
    {
        $this->addAuctionQuantity = $addAuctionQuantity;
    }

    #[Assert\Valid]
    public function getAddBaseProducts(): ?AddBaseProducts
    {
        return $this->addBaseProducts;
    }

    public function setAddBaseProducts(?AddBaseProducts $addBaseProducts): void
    {
        $this->addBaseProducts = $addBaseProducts;
    }

    #[Assert\Valid]
    public function getAddCatalogs(): ?AddCatalogs
    {
        return $this->addCatalogs;
    }

    public function setAddCatalogs(?AddCatalogs $addCatalogs): void
    {
        $this->addCatalogs = $addCatalogs;
    }

    /**
     * @return AdditionalDescriptionField[]
     */
    #[Assert\Count(min: 0, max: 10)]
    #[Assert\Valid]
    public function getAdditionalDescriptionFields(): array
    {
        return $this->additionalDescriptionFields;
    }

    /**
     * @param AdditionalDescriptionField[] $additionalDescriptionFields
     */
    public function setAdditionalDescriptionFields(array $additionalDescriptionFields): void
    {
        $this->additionalDescriptionFields = $additionalDescriptionFields;
    }

    /**
     * @return AdditionalPriceUpdate[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getAdditionalPriceUpdates(): array
    {
        return $this->additionalPriceUpdates;
    }

    /**
     * @param AdditionalPriceUpdate[] $additionalPriceUpdates
     */
    public function setAdditionalPriceUpdates(array $additionalPriceUpdates): void
    {
        $this->additionalPriceUpdates = $additionalPriceUpdates;
    }

    public function getAddQuantity(): ?int
    {
        return $this->addQuantity;
    }

    public function setAddQuantity(?int $addQuantity): void
    {
        $this->addQuantity = $addQuantity;
    }

    public function getAgeGroup(): ?AgeGroupEnum
    {
        return $this->ageGroupEnum;
    }

    public function setAgeGroup(?AgeGroupEnum $ageGroupEnum): void
    {
        $this->ageGroupEnum = $ageGroupEnum;
    }

    public function getAnr(): ?int
    {
        return $this->anr;
    }

    public function setAnr(?int $anr): void
    {
        $this->anr = $anr;
    }

    public function getAuctionQuantity(): ?int
    {
        return $this->auctionQuantity;
    }

    public function setAuctionQuantity(?int $auctionQuantity): void
    {
        $this->auctionQuantity = $auctionQuantity;
    }

    public function getBasepriceFactor(): ?BasePriceFactorEnum
    {
        return $this->basePriceFactorEnum;
    }

    public function setBasepriceFactor(?BasePriceFactorEnum $basePriceFactorEnum): void
    {
        $this->basePriceFactorEnum = $basePriceFactorEnum;
    }

    public function getBuyingPrice(): ?float
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(?float $buyingPrice): void
    {
        $this->buyingPrice = $buyingPrice;
    }

    #[Assert\Length(max: 300)]
    public function getCanonicalUrl(): ?string
    {
        return $this->canonicalUrl;
    }

    public function setCanonicalUrl(?string $canonicalUrl): void
    {
        $this->canonicalUrl = $canonicalUrl;
    }

    public function getCondition(): ?ConditionEnum
    {
        return $this->conditionEnum;
    }

    public function setCondition(?ConditionEnum $conditionEnum): void
    {
        $this->conditionEnum = $conditionEnum;
    }

    public function getCountryOfOrigin(): ?CountryOfOriginEnum
    {
        return $this->countryOfOriginEnum;
    }

    public function setCountryOfOrigin(?CountryOfOriginEnum $countryOfOriginEnum): void
    {
        $this->countryOfOriginEnum = $countryOfOriginEnum;
    }

    public function getCrossCatalogId(): ?int
    {
        return $this->crossCatalogId;
    }

    public function setCrossCatalogId(?int $crossCatalogId): void
    {
        $this->crossCatalogId = $crossCatalogId;
    }

    public function getCustomsTariffNumber(): ?string
    {
        return $this->customsTariffNumber;
    }

    public function setCustomsTariffNumber(?string $customsTariffNumber): void
    {
        $this->customsTariffNumber = $customsTariffNumber;
    }

    public function getDataSheetUrl(): ?string
    {
        return $this->dataSheetUrl;
    }

    public function setDataSheetUrl(?string $dataSheetUrl): void
    {
        $this->dataSheetUrl = $dataSheetUrl;
    }

    public function getDealerPrice(): ?float
    {
        return $this->dealerPrice;
    }

    public function setDealerPrice(?float $dealerPrice): void
    {
        $this->dealerPrice = $dealerPrice;
    }

    #[Assert\Length(max: 255)]
    public function getDeliveryTime(): ?string
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(?string $deliveryTime): void
    {
        $this->deliveryTime = $deliveryTime;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getDiscontinued(): ?bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(?bool $discontinued): void
    {
        $this->discontinued = $discontinued;
    }

    public function getEan(): ?string
    {
        return $this->ean;
    }

    public function setEan(?string $ean): void
    {
        $this->ean = $ean;
    }

    #[Assert\Valid]
    public function getEconomicoperators(): ?Economicoperators
    {
        return $this->economicoperators;
    }

    public function setEconomicoperators(?Economicoperators $economicoperators): void
    {
        $this->economicoperators = $economicoperators;
    }

    public function getEnergyClass(): ?EnergyClassEnum
    {
        return $this->energyClassEnum;
    }

    public function setEnergyClass(?EnergyClassEnum $energyClassEnum): void
    {
        $this->energyClassEnum = $energyClassEnum;
    }

    public function getEnergyClassPictureUrl(): ?string
    {
        return $this->energyClassPictureUrl;
    }

    public function setEnergyClassPictureUrl(?string $energyClassPictureUrl): void
    {
        $this->energyClassPictureUrl = $energyClassPictureUrl;
    }

    /**
     * @return Feature[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @param Feature[] $features
     */
    public function setFeatures(array $features): void
    {
        $this->features = $features;
    }

    public function getFooterId(): ?int
    {
        return $this->footerId;
    }

    public function setFooterId(?int $footerId): void
    {
        $this->footerId = $footerId;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue1(): ?string
    {
        return $this->freeValue1;
    }

    public function setFreeValue1(?string $freeValue1): void
    {
        $this->freeValue1 = $freeValue1;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue2(): ?string
    {
        return $this->freeValue2;
    }

    public function setFreeValue2(?string $freeValue2): void
    {
        $this->freeValue2 = $freeValue2;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue3(): ?string
    {
        return $this->freeValue3;
    }

    public function setFreeValue3(?string $freeValue3): void
    {
        $this->freeValue3 = $freeValue3;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue4(): ?string
    {
        return $this->freeValue4;
    }

    public function setFreeValue4(?string $freeValue4): void
    {
        $this->freeValue4 = $freeValue4;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue5(): ?string
    {
        return $this->freeValue5;
    }

    public function setFreeValue5(?string $freeValue5): void
    {
        $this->freeValue5 = $freeValue5;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue6(): ?string
    {
        return $this->freeValue6;
    }

    public function setFreeValue6(?string $freeValue6): void
    {
        $this->freeValue6 = $freeValue6;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue7(): ?string
    {
        return $this->freeValue7;
    }

    public function setFreeValue7(?string $freeValue7): void
    {
        $this->freeValue7 = $freeValue7;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue8(): ?string
    {
        return $this->freeValue8;
    }

    public function setFreeValue8(?string $freeValue8): void
    {
        $this->freeValue8 = $freeValue8;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue9(): ?string
    {
        return $this->freeValue9;
    }

    public function setFreeValue9(?string $freeValue9): void
    {
        $this->freeValue9 = $freeValue9;
    }

    #[Assert\Length(max: 500)]
    public function getFreeValue10(): ?string
    {
        return $this->freeValue10;
    }

    public function setFreeValue10(?string $freeValue10): void
    {
        $this->freeValue10 = $freeValue10;
    }

    public function getFroogle(): ?bool
    {
        return $this->froogle;
    }

    public function setFroogle(?bool $froogle): void
    {
        $this->froogle = $froogle;
    }

    public function getGender(): ?GenderEnum
    {
        return $this->genderEnum;
    }

    public function setGender(?GenderEnum $genderEnum): void
    {
        $this->genderEnum = $genderEnum;
    }

    #[Assert\Length(max: 255)]
    public function getGoogleProductCategory(): ?string
    {
        return $this->googleProductCategory;
    }

    public function setGoogleProductCategory(?string $googleProductCategory): void
    {
        $this->googleProductCategory = $googleProductCategory;
    }

    public function getHeaderId(): ?int
    {
        return $this->headerId;
    }

    public function setHeaderId(?int $headerId): void
    {
        $this->headerId = $headerId;
    }

    public function getImageLargeUrl(): ?string
    {
        return $this->imageLargeUrl;
    }

    public function setImageLargeUrl(?string $imageLargeUrl): void
    {
        $this->imageLargeUrl = $imageLargeUrl;
    }

    public function getImageNameBase64(): ?string
    {
        return $this->imageNameBase64;
    }

    public function setImageNameBase64(?string $imageNameBase64): void
    {
        $this->imageNameBase64 = $imageNameBase64;
    }

    public function getImageSmallUrl(): ?string
    {
        return $this->imageSmallUrl;
    }

    public function setImageSmallUrl(?string $imageSmallUrl): void
    {
        $this->imageSmallUrl = $imageSmallUrl;
    }

    public function getImageSourceBase64(): ?string
    {
        return $this->imageSourceBase64;
    }

    public function setImageSourceBase64(?string $imageSourceBase64): void
    {
        $this->imageSourceBase64 = $imageSourceBase64;
    }

    public function getItemColor(): ?string
    {
        return $this->itemColor;
    }

    public function setItemColor(?string $itemColor): void
    {
        $this->itemColor = $itemColor;
    }

    #[Assert\Length(max: 25)]
    public function getItemSize(): ?string
    {
        return $this->itemSize;
    }

    public function setItemSize(?string $itemSize): void
    {
        $this->itemSize = $itemSize;
    }

    public function getKelkoo(): ?bool
    {
        return $this->kelkoo;
    }

    public function setKelkoo(?bool $kelkoo): void
    {
        $this->kelkoo = $kelkoo;
    }

    #[Assert\Length(max: 1000)]
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    #[Assert\Length(max: 255)]
    public function getManufacturerPartNumber(): ?string
    {
        return $this->manufacturerPartNumber;
    }

    public function setManufacturerPartNumber(?string $manufacturerPartNumber): void
    {
        $this->manufacturerPartNumber = $manufacturerPartNumber;
    }

    public function getManufacturerStandardProductIdType(): ?string
    {
        return $this->manufacturerStandardProductIdType;
    }

    public function setManufacturerStandardProductIdType(?string $manufacturerStandardProductIdType): void
    {
        $this->manufacturerStandardProductIdType = $manufacturerStandardProductIdType;
    }

    public function getManufacturerStandardProductIdValue(): ?string
    {
        return $this->manufacturerStandardProductIdValue;
    }

    public function setManufacturerStandardProductIdValue(?string $manufacturerStandardProductIdValue): void
    {
        $this->manufacturerStandardProductIdValue = $manufacturerStandardProductIdValue;
    }

    #[Assert\Length(max: 200)]
    public function getMaterial(): ?string
    {
        return $this->material;
    }

    public function setMaterial(?string $material): void
    {
        $this->material = $material;
    }

    public function getMemo(): ?string
    {
        return $this->memo;
    }

    public function setMemo(?string $memo): void
    {
        $this->memo = $memo;
    }

    public function getMergeStock(): ?bool
    {
        return $this->mergeStock;
    }

    public function setMergeStock(?bool $mergeStock): void
    {
        $this->mergeStock = $mergeStock;
    }

    public function getMinimumStock(): ?int
    {
        return $this->minimumStock;
    }

    public function setMinimumStock(?int $minimumStock): void
    {
        $this->minimumStock = $minimumStock;
    }

    #[Assert\Length(max: 255)]
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return PartsProperties[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getPartsFitment(): array
    {
        return $this->partsFitment;
    }

    /**
     * @param PartsProperties[] $partsFitment
     */
    public function setPartsFitment(array $partsFitment): void
    {
        $this->partsFitment = $partsFitment;
    }

    public function getPattern(): ?string
    {
        return $this->pattern;
    }

    public function setPattern(?string $pattern): void
    {
        $this->pattern = $pattern;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }

    public function getProductBrand(): ?string
    {
        return $this->productBrand;
    }

    public function setProductBrand(?string $productBrand): void
    {
        $this->productBrand = $productBrand;
    }

    #[Assert\Valid]
    public function getProductIdent(): ProductIdent
    {
        return $this->productIdent;
    }

    public function setProductIdent(ProductIdent $productIdent): void
    {
        $this->productIdent = $productIdent;
    }

    /**
     * @return ProductPicture[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getProductPictures(): array
    {
        return $this->productPictures;
    }

    /**
     * @param ProductPicture[] $productPictures
     */
    public function setProductPictures(array $productPictures): void
    {
        $this->productPictures = $productPictures;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(?int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return ScaledDiscount[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getScaledDiscounts(): array
    {
        return $this->scaledDiscounts;
    }

    /**
     * @param ScaledDiscount[] $scaledDiscounts
     */
    public function setScaledDiscounts(array $scaledDiscounts): void
    {
        $this->scaledDiscounts = $scaledDiscounts;
    }

    #[Assert\Length(max: 255)]
    public function getSearchAlias(): ?string
    {
        return $this->searchAlias;
    }

    public function setSearchAlias(?string $searchAlias): void
    {
        $this->searchAlias = $searchAlias;
    }

    public function getSellingPrice(): ?float
    {
        return $this->sellingPrice;
    }

    public function setSellingPrice(?float $sellingPrice): void
    {
        $this->sellingPrice = $sellingPrice;
    }

    public function getShippingGroup(): ?string
    {
        return $this->shippingGroup;
    }

    public function setShippingGroup(?string $shippingGroup): void
    {
        $this->shippingGroup = $shippingGroup;
    }

    public function getShopShippingGroup(): ?string
    {
        return $this->shopShippingGroup;
    }

    public function setShopShippingGroup(?string $shopShippingGroup): void
    {
        $this->shopShippingGroup = $shopShippingGroup;
    }

    #[Assert\Length(max: 800)]
    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    #[Assert\Valid]
    public function getSkus(): ?Skus
    {
        return $this->skus;
    }

    public function setSkus(?Skus $skus): void
    {
        $this->skus = $skus;
    }

    public function getStock(): ?bool
    {
        return $this->stock;
    }

    public function setStock(?bool $stock): void
    {
        $this->stock = $stock;
    }

    public function getStocklocation1(): ?string
    {
        return $this->stocklocation_1;
    }

    public function setStocklocation1(?string $stocklocation_1): void
    {
        $this->stocklocation_1 = $stocklocation_1;
    }

    public function getStocklocation2(): ?string
    {
        return $this->stocklocation_2;
    }

    public function setStocklocation2(?string $stocklocation_2): void
    {
        $this->stocklocation_2 = $stocklocation_2;
    }

    public function getStocklocation3(): ?string
    {
        return $this->stocklocation_3;
    }

    public function setStocklocation3(?string $stocklocation_3): void
    {
        $this->stocklocation_3 = $stocklocation_3;
    }

    public function getStocklocation4(): ?string
    {
        return $this->stocklocation_4;
    }

    public function setStocklocation4(?string $stocklocation_4): void
    {
        $this->stocklocation_4 = $stocklocation_4;
    }

    /**
     * @return string[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\All([
        new Assert\Type('string'),
        new Assert\Length(max: 50),
    ])]
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param string[] $tags
     */
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function getTaxRate(): ?float
    {
        return $this->taxRate;
    }

    public function setTaxRate(?float $taxRate): void
    {
        $this->taxRate = $taxRate;
    }

    public function getTitleReplace(): ?bool
    {
        return $this->titleReplace;
    }

    public function setTitleReplace(?bool $titleReplace): void
    {
        $this->titleReplace = $titleReplace;
    }

    public function getUnitOfQuantity(): ?float
    {
        return $this->unitOfQuantity;
    }

    public function setUnitOfQuantity(?float $unitOfQuantity): void
    {
        $this->unitOfQuantity = $unitOfQuantity;
    }

    /**
     * @return Variation[]
     */
    #[Assert\Count(min: 0)]
    #[Assert\Valid]
    public function getUseEbayVariations(): array
    {
        return $this->useEbayVariations;
    }

    /**
     * @param Variation[] $useEbayVariations
     */
    public function setUseEbayVariations(array $useEbayVariations): void
    {
        $this->useEbayVariations = $useEbayVariations;
    }

    public function getWeight(): ?float
    {
        return $this->weight;
    }

    public function setWeight(?float $weight): void
    {
        $this->weight = $weight;
    }
}
