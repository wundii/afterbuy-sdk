# Wundii\AfterbuySdk\Dto\GetListerHistory\ListedItems
- [Back to Structron Documentation](./../_Structron.md)
- [Go to ListedItems.php](./../../src/Dto/GetListerHistory/ListedItems.php)

Hold a list of items that were listed in the Lister history.

| ListedItems                                     | Type                    | Default  | Description |
| ----------------------------------------------- | ----------------------- | -------- | ----------- |
| resultCount                                     | int                     | 0        |             |
| hasMoreProducts                                 | bool                    | false    |             |
| **listedItems**                                 | ListedItem[]            | []       |             |
| &nbsp; listedItems.historyId                    | int                     | required |             |
| &nbsp; listedItems.listingId                    | int                     | required |             |
| &nbsp; listedItems.productId                    | int                     | required |             |
| &nbsp; listedItems.variationType                | int                     | null     |             |
| **&nbsp; listedItems.listingDetails**           | ListingDetails          | null     |             |
| &nbsp; &nbsp; listingDetails.anr                | int                     | required |             |
| &nbsp; &nbsp; listingDetails.soldItems          | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.listedQuantity     | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.listingPlattform   | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.listingTitle       | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.listerSubTitle     | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.listingDuration    | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.listingType        | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.listingDescription | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.listingFee         | float                   | null     |             |
| &nbsp; &nbsp; listingDetails.listingCountryEnum | ListingCountryEnum      | null     |             |
| &nbsp; &nbsp; listingDetails.sellStatusEnum     | SellStatusEnum          | null     |             |
| &nbsp; &nbsp; listingDetails.startTime          | DateTimeInterface       | null     |             |
| &nbsp; &nbsp; listingDetails.endTime            | DateTimeInterface       | null     |             |
| &nbsp; &nbsp; listingDetails.ebayCurrencyId     | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.ebayCurrencyEnum   | EbayCurrencyEnum        | null     |             |
| &nbsp; &nbsp; listingDetails.ebayCategoryId     | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.ebayCategory2Id    | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.ebaySubAccountId   | int                     | null     |             |
| &nbsp; &nbsp; listingDetails.ebayStartprice     | float                   | null     |             |
| &nbsp; &nbsp; listingDetails.ebayBuyItNowPrice  | float                   | null     |             |
| &nbsp; &nbsp; listingDetails.ebayPictureUrl     | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.ebayGaleryUrl      | string                  | null     |             |
| &nbsp; &nbsp; listingDetails.ebayRelist         | bool                    | null     |             |
| **&nbsp; listedItems.productDetails**           | ProductDetails          | null     |             |
| &nbsp; &nbsp; productDetails.name               | string                  | required |             |
| &nbsp; &nbsp; productDetails.shortDescription   | string                  | null     |             |
| **&nbsp; &nbsp; productDetails.catalogs**       | ProductDetailsCatalog[] | []       |             |
| &nbsp; &nbsp; &nbsp; catalogs.catalogID         | int                     | null     |             |
| &nbsp; &nbsp; &nbsp; catalogs.catalogPath       | string                  | null     |             |
| &nbsp; &nbsp; &nbsp; catalogs.catalogURL        | string                  | null     |             |
| lastHistoryId                                   | int                     | null     |             |
