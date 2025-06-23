# Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalogs
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Catalogs.php](./../../src/Dto/GetShopCatalogs/Catalogs.php)

Holds a list of catalogs.

| Catalogs                        | Type                                             | Default  | Description |
| ------------------------------- | ------------------------------------------------ | -------- | ----------- |
| hasMoreCatalogs                 | bool                                             | false    |             |
| **catalogs**                    | Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalog[] | []       |             |
| &nbsp; catalogs.catalogId       | int                                              | required |             |
| &nbsp; catalogs.name            | string                                           | required |             |
| &nbsp; catalogs.level           | int                                              | required |             |
| &nbsp; catalogs.position        | int                                              | required |             |
| &nbsp; catalogs.description     | string                                           | null     |             |
| &nbsp; catalogs.parnetId        | int                                              | null     |             |
| &nbsp; catalogs.additionalText  | string                                           | null     |             |
| &nbsp; catalogs.show            | bool                                             | false    |             |
| &nbsp; catalogs.picture1        | string                                           | null     |             |
| &nbsp; catalogs.picture2        | string                                           | null     |             |
| &nbsp; catalogs.titlePicture    | string                                           | null     |             |
| &nbsp; catalogs.catalogProducts | int[]                                            | []       |             |
| lastCatalogId                   | int                                              | null     |             |
