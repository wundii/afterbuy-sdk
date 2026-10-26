# Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalogs
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Catalogs.php](./../../src/Dto/GetShopCatalogs/Catalogs.php)

Holds a list of catalogs.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetShopCatalogs\Catalog | Catalog |

## Properties
| Catalogs                 | Type      | Default  | Description                                                                                               |
| ------------------------ | --------- | -------- | --------------------------------------------------------------------------------------------------------- |
| hasMoreCatalogs          | bool      | false    | True if more catalogs exist than were returned (max. 200 per request); continue paging with lastCatalogId |
| **catalogs**             | Catalog[] | []       |                                                                                                           |
| catalogs.catalogId       | int       | required |                                                                                                           |
| catalogs.name            | string    | required |                                                                                                           |
| catalogs.level           | int       | required |                                                                                                           |
| catalogs.position        | int       | required |                                                                                                           |
| catalogs.description     | string    | null     |                                                                                                           |
| catalogs.parnetId        | int       | null     |                                                                                                           |
| catalogs.additionalText  | string    | null     |                                                                                                           |
| catalogs.show            | bool      | false    |                                                                                                           |
| catalogs.picture1        | string    | null     |                                                                                                           |
| catalogs.picture2        | string    | null     |                                                                                                           |
| catalogs.titlePicture    | string    | null     |                                                                                                           |
| catalogs.catalogProducts | int[]     | []       |                                                                                                           |
| lastCatalogId            | int       | null     | Highest CatalogID in this response; use it as start value for the next request                            |
