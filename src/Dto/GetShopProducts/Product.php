<?php

declare(strict_types=1);

namespace Wundii\AfterbuySdk\Dto\GetShopProducts;

use DateTimeInterface;
use Wundii\AfterbuySdk\Enum\BaseProductFlagEnum;
use Wundii\AfterbuySdk\Enum\ConditionEnum;
use Wundii\AfterbuySdk\Enum\EnergyClassEnum;
use Wundii\AfterbuySdk\Interface\AfterbuyDtoInterface;

final class Product implements AfterbuyDtoInterface
{
    /**
     * @param BaseProduct[] $baseProducts
     * @param string[] $tags
     * @param ScaledDiscount[] $scaledDiscounts
     * @param Feature[] $features
     * @param string[] $skus
     * @param ProductPicture[] $productPictures
     * @param int[] $catalogs
     * @param Attribute[] $attributes
     * @param PartsProperties[] $partsFitment
     * @param AdditionalDescriptionField[] $additionalDescriptionFields
     * @param AdditionalPrice[] $additionalPrices
     * @param EconomicOperator[] $economicOperators
     */
    public function __construct(
        private int $shop20Id,
        private int $productId,
        private int $anr,
        private string $ean,
        private string $name,
        private ?DateTimeInterface $modDate = null,
        private ?string $variationName = null,
        private ?BaseProductFlagEnum $baseProductFlagEnum = null,
        private array $baseProducts = [],
        private ?string $shortDescription = null,
        private array $tags = [],
        private ?string $memo = null,
        private ?string $headerDescriptionName = null,
        private ?string $headerDescriptionValue = null,
        private ?string $description = null,
        private ?string $footerDescriptionName = null,
        private ?string $footerDescriptionValue = null,
        private ?string $googleBaseShipping = null,
        private ?string $keywords = null,
        private int $quantity = 1,
        private bool $availableShop = false,
        private int $auctionQuantity = 0,
        private bool $stock = false,
        private bool $discontinued = false,
        private bool $mergeStock = false,
        private ?string $unitOfQuantity = null,
        private ?float $basepriceFactor = null,
        private ?int $minimumStock = null,
        private ?int $minimumOrderQuantity = null,
        private ?int $fullFilmentQuantity = null,
        private ?DateTimeInterface $fullFilmentImport = null,
        private ?float $sellingPrice = null,
        private ?float $buyingPrice = null,
        private ?float $dealerPrice = null,
        private ?int $level = null,
        private ?int $position = null,
        private bool $ttitleReplace = false,
        private bool $titleReplace = false,
        private array $scaledDiscounts = [],
        private ?float $taxRate = null,
        private ?float $weight = null,
        private ?string $searchAlias = null,
        private bool $froogle = false,
        private bool $kelkoo = false,
        private ?string $shippingGroup = null,
        private ?string $shopShippingGroup = null,
        private ?string $searchEngineShipping = null,
        private ?int $crossCatalogID = null,
        private array $features = [],
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
        private ?string $stocklocation_1 = null,
        private ?string $stocklocation_2 = null,
        private ?string $stocklocation_3 = null,
        private ?string $stocklocation_4 = null,
        private ?string $countryOfOrigin = null,
        private ?string $lastSale = null,
        private ?string $imageSmallURL = null,
        private ?string $imageLargeURL = null,
        private ?string $manufacturerStandardProductIDType = null,
        private ?string $manufacturerStandardProductIDValue = null,
        private ?string $productBrand = null,
        private ?string $manufacturerPartNumber = null,
        private ?string $googleProductCategory = null,
        private ConditionEnum $conditionEnum = ConditionEnum::NO_CONDITION,
        private ?string $pattern = null,
        private ?string $material = null,
        private ?string $itemColor = null,
        private ?string $itemSize = null,
        private ?string $canonicalUrl = null,
        private EnergyClassEnum $energyClassEnum = EnergyClassEnum::NO_CLASS,
        private ?string $dataSheetUrl = null,
        private array $skus = [],
        private array $productPictures = [],
        private array $catalogs = [],
        private array $attributes = [],
        private array $partsFitment = [],
        private array $additionalDescriptionFields = [],
        private array $additionalPrices = [],
        private array $economicOperators = [],
    ) {
    }

    /**
     * @return AdditionalDescriptionField[]
     */
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
     * @return AdditionalPrice[]
     */
    public function getAdditionalPrices(): array
    {
        return $this->additionalPrices;
    }

    /**
     * @param AdditionalPrice[] $additionalPrices
     */
    public function setAdditionalPrices(array $additionalPrices): void
    {
        $this->additionalPrices = $additionalPrices;
    }

    public function getAnr(): int
    {
        return $this->anr;
    }

    public function setAnr(int $anr): void
    {
        $this->anr = $anr;
    }

    /**
     * @return Attribute[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @param Attribute[] $attributes
     */
    public function setAttributes(array $attributes): void
    {
        $this->attributes = $attributes;
    }

    public function getAuctionQuantity(): int
    {
        return $this->auctionQuantity;
    }

    public function setAuctionQuantity(int $auctionQuantity): void
    {
        $this->auctionQuantity = $auctionQuantity;
    }

    public function isAvailableShop(): bool
    {
        return $this->availableShop;
    }

    public function setAvailableShop(bool $availableShop): void
    {
        $this->availableShop = $availableShop;
    }

    public function getBasepriceFactor(): ?float
    {
        return $this->basepriceFactor;
    }

    public function setBasepriceFactor(?float $basepriceFactor): void
    {
        $this->basepriceFactor = $basepriceFactor;
    }

    public function getBaseProductFlag(): ?BaseProductFlagEnum
    {
        return $this->baseProductFlagEnum;
    }

    public function setBaseProductFlag(?BaseProductFlagEnum $baseProductFlagEnum): void
    {
        $this->baseProductFlagEnum = $baseProductFlagEnum;
    }

    /**
     * @return BaseProduct[]
     */
    public function getBaseProducts(): array
    {
        return $this->baseProducts;
    }

    /**
     * @param BaseProduct[] $baseProducts
     */
    public function setBaseProducts(array $baseProducts): void
    {
        $this->baseProducts = $baseProducts;
    }

    public function getBuyingPrice(): ?float
    {
        return $this->buyingPrice;
    }

    public function setBuyingPrice(?float $buyingPrice): void
    {
        $this->buyingPrice = $buyingPrice;
    }

    public function getCanonicalUrl(): ?string
    {
        return $this->canonicalUrl;
    }

    public function setCanonicalUrl(?string $canonicalUrl): void
    {
        $this->canonicalUrl = $canonicalUrl;
    }

    /**
     * @return int[]
     */
    public function getCatalogs(): array
    {
        return $this->catalogs;
    }

    /**
     * @param int[] $catalogs
     */
    public function setCatalogs(array $catalogs): void
    {
        $this->catalogs = $catalogs;
    }

    public function getCondition(): ConditionEnum
    {
        return $this->conditionEnum;
    }

    public function setCondition(ConditionEnum $conditionEnum): void
    {
        $this->conditionEnum = $conditionEnum;
    }

    public function getCountryOfOrigin(): ?string
    {
        return $this->countryOfOrigin;
    }

    public function setCountryOfOrigin(?string $countryOfOrigin): void
    {
        $this->countryOfOrigin = $countryOfOrigin;
    }

    public function getCrossCatalogID(): ?int
    {
        return $this->crossCatalogID;
    }

    public function setCrossCatalogID(?int $crossCatalogID): void
    {
        $this->crossCatalogID = $crossCatalogID;
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

    public function isDiscontinued(): bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): void
    {
        $this->discontinued = $discontinued;
    }

    public function getEan(): string
    {
        return $this->ean;
    }

    public function setEan(string $ean): void
    {
        $this->ean = $ean;
    }

    /**
     * @return EconomicOperator[]
     */
    public function getEconomicOperators(): array
    {
        return $this->economicOperators;
    }

    /**
     * @param EconomicOperator[] $economicOperators
     */
    public function setEconomicOperators(array $economicOperators): void
    {
        $this->economicOperators = $economicOperators;
    }

    public function getEnergyClass(): EnergyClassEnum
    {
        return $this->energyClassEnum;
    }

    public function setEnergyClass(EnergyClassEnum $energyClassEnum): void
    {
        $this->energyClassEnum = $energyClassEnum;
    }

    /**
     * @return Feature[]
     */
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

    public function getFooterDescriptionName(): ?string
    {
        return $this->footerDescriptionName;
    }

    public function setFooterDescriptionName(?string $footerDescriptionName): void
    {
        $this->footerDescriptionName = $footerDescriptionName;
    }

    public function getFooterDescriptionValue(): ?string
    {
        return $this->footerDescriptionValue;
    }

    public function setFooterDescriptionValue(?string $footerDescriptionValue): void
    {
        $this->footerDescriptionValue = $footerDescriptionValue;
    }

    public function getFreeValue1(): ?string
    {
        return $this->freeValue1;
    }

    public function setFreeValue1(?string $freeValue1): void
    {
        $this->freeValue1 = $freeValue1;
    }

    public function getFreeValue10(): ?string
    {
        return $this->freeValue10;
    }

    public function setFreeValue10(?string $freeValue10): void
    {
        $this->freeValue10 = $freeValue10;
    }

    public function getFreeValue2(): ?string
    {
        return $this->freeValue2;
    }

    public function setFreeValue2(?string $freeValue2): void
    {
        $this->freeValue2 = $freeValue2;
    }

    public function getFreeValue3(): ?string
    {
        return $this->freeValue3;
    }

    public function setFreeValue3(?string $freeValue3): void
    {
        $this->freeValue3 = $freeValue3;
    }

    public function getFreeValue4(): ?string
    {
        return $this->freeValue4;
    }

    public function setFreeValue4(?string $freeValue4): void
    {
        $this->freeValue4 = $freeValue4;
    }

    public function getFreeValue5(): ?string
    {
        return $this->freeValue5;
    }

    public function setFreeValue5(?string $freeValue5): void
    {
        $this->freeValue5 = $freeValue5;
    }

    public function getFreeValue6(): ?string
    {
        return $this->freeValue6;
    }

    public function setFreeValue6(?string $freeValue6): void
    {
        $this->freeValue6 = $freeValue6;
    }

    public function getFreeValue7(): ?string
    {
        return $this->freeValue7;
    }

    public function setFreeValue7(?string $freeValue7): void
    {
        $this->freeValue7 = $freeValue7;
    }

    public function getFreeValue8(): ?string
    {
        return $this->freeValue8;
    }

    public function setFreeValue8(?string $freeValue8): void
    {
        $this->freeValue8 = $freeValue8;
    }

    public function getFreeValue9(): ?string
    {
        return $this->freeValue9;
    }

    public function setFreeValue9(?string $freeValue9): void
    {
        $this->freeValue9 = $freeValue9;
    }

    public function isFroogle(): bool
    {
        return $this->froogle;
    }

    public function setFroogle(bool $froogle): void
    {
        $this->froogle = $froogle;
    }

    public function getFullFilmentImport(): ?DateTimeInterface
    {
        return $this->fullFilmentImport;
    }

    public function setFullFilmentImport(?DateTimeInterface $fullFilmentImport): void
    {
        $this->fullFilmentImport = $fullFilmentImport;
    }

    public function getFullFilmentQuantity(): ?int
    {
        return $this->fullFilmentQuantity;
    }

    public function setFullFilmentQuantity(?int $fullFilmentQuantity): void
    {
        $this->fullFilmentQuantity = $fullFilmentQuantity;
    }

    public function getGoogleBaseShipping(): ?string
    {
        return $this->googleBaseShipping;
    }

    public function setGoogleBaseShipping(?string $googleBaseShipping): void
    {
        $this->googleBaseShipping = $googleBaseShipping;
    }

    public function getGoogleProductCategory(): ?string
    {
        return $this->googleProductCategory;
    }

    public function setGoogleProductCategory(?string $googleProductCategory): void
    {
        $this->googleProductCategory = $googleProductCategory;
    }

    public function getHeaderDescriptionName(): ?string
    {
        return $this->headerDescriptionName;
    }

    public function setHeaderDescriptionName(?string $headerDescriptionName): void
    {
        $this->headerDescriptionName = $headerDescriptionName;
    }

    public function getHeaderDescriptionValue(): ?string
    {
        return $this->headerDescriptionValue;
    }

    public function setHeaderDescriptionValue(?string $headerDescriptionValue): void
    {
        $this->headerDescriptionValue = $headerDescriptionValue;
    }

    public function getImageLargeURL(): ?string
    {
        return $this->imageLargeURL;
    }

    public function setImageLargeURL(?string $imageLargeURL): void
    {
        $this->imageLargeURL = $imageLargeURL;
    }

    public function getImageSmallURL(): ?string
    {
        return $this->imageSmallURL;
    }

    public function setImageSmallURL(?string $imageSmallURL): void
    {
        $this->imageSmallURL = $imageSmallURL;
    }

    public function getItemColor(): ?string
    {
        return $this->itemColor;
    }

    public function setItemColor(?string $itemColor): void
    {
        $this->itemColor = $itemColor;
    }

    public function getItemSize(): ?string
    {
        return $this->itemSize;
    }

    public function setItemSize(?string $itemSize): void
    {
        $this->itemSize = $itemSize;
    }

    public function isKelkoo(): bool
    {
        return $this->kelkoo;
    }

    public function setKelkoo(bool $kelkoo): void
    {
        $this->kelkoo = $kelkoo;
    }

    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    public function getLastSale(): ?string
    {
        return $this->lastSale;
    }

    public function setLastSale(?string $lastSale): void
    {
        $this->lastSale = $lastSale;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(?int $level): void
    {
        $this->level = $level;
    }

    public function getManufacturerPartNumber(): ?string
    {
        return $this->manufacturerPartNumber;
    }

    public function setManufacturerPartNumber(?string $manufacturerPartNumber): void
    {
        $this->manufacturerPartNumber = $manufacturerPartNumber;
    }

    public function getManufacturerStandardProductIDType(): ?string
    {
        return $this->manufacturerStandardProductIDType;
    }

    public function setManufacturerStandardProductIDType(?string $manufacturerStandardProductIDType): void
    {
        $this->manufacturerStandardProductIDType = $manufacturerStandardProductIDType;
    }

    public function getManufacturerStandardProductIDValue(): ?string
    {
        return $this->manufacturerStandardProductIDValue;
    }

    public function setManufacturerStandardProductIDValue(?string $manufacturerStandardProductIDValue): void
    {
        $this->manufacturerStandardProductIDValue = $manufacturerStandardProductIDValue;
    }

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

    public function isMergeStock(): bool
    {
        return $this->mergeStock;
    }

    public function setMergeStock(bool $mergeStock): void
    {
        $this->mergeStock = $mergeStock;
    }

    public function getMinimumOrderQuantity(): ?int
    {
        return $this->minimumOrderQuantity;
    }

    public function setMinimumOrderQuantity(?int $minimumOrderQuantity): void
    {
        $this->minimumOrderQuantity = $minimumOrderQuantity;
    }

    public function getMinimumStock(): ?int
    {
        return $this->minimumStock;
    }

    public function setMinimumStock(?int $minimumStock): void
    {
        $this->minimumStock = $minimumStock;
    }

    public function getModDate(): ?DateTimeInterface
    {
        return $this->modDate;
    }

    public function setModDate(?DateTimeInterface $modDate): void
    {
        $this->modDate = $modDate;
    }

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

    public function getProductId(): int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return ProductPicture[]
     */
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

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    /**
     * @return ScaledDiscount[]
     */
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

    public function getSearchAlias(): ?string
    {
        return $this->searchAlias;
    }

    public function setSearchAlias(?string $searchAlias): void
    {
        $this->searchAlias = $searchAlias;
    }

    public function getSearchEngineShipping(): ?string
    {
        return $this->searchEngineShipping;
    }

    public function setSearchEngineShipping(?string $searchEngineShipping): void
    {
        $this->searchEngineShipping = $searchEngineShipping;
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

    public function getShop20Id(): int
    {
        return $this->shop20Id;
    }

    public function setShop20Id(int $shop20Id): void
    {
        $this->shop20Id = $shop20Id;
    }

    public function getShopShippingGroup(): ?string
    {
        return $this->shopShippingGroup;
    }

    public function setShopShippingGroup(?string $shopShippingGroup): void
    {
        $this->shopShippingGroup = $shopShippingGroup;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return string[]
     */
    public function getSkus(): array
    {
        return $this->skus;
    }

    /**
     * @param string[] $skus
     */
    public function setSkus(array $skus): void
    {
        $this->skus = $skus;
    }

    public function isStock(): bool
    {
        return $this->stock;
    }

    public function setStock(bool $stock): void
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

    public function isTitleReplace(): bool
    {
        return $this->titleReplace;
    }

    public function setTitleReplace(bool $titleReplace): void
    {
        $this->titleReplace = $titleReplace;
    }

    public function isTtitleReplace(): bool
    {
        return $this->ttitleReplace;
    }

    public function setTtitleReplace(bool $ttitleReplace): void
    {
        $this->ttitleReplace = $ttitleReplace;
    }

    public function getUnitOfQuantity(): ?string
    {
        return $this->unitOfQuantity;
    }

    public function setUnitOfQuantity(?string $unitOfQuantity): void
    {
        $this->unitOfQuantity = $unitOfQuantity;
    }

    public function getVariationName(): ?string
    {
        return $this->variationName;
    }

    public function setVariationName(?string $variationName): void
    {
        $this->variationName = $variationName;
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
