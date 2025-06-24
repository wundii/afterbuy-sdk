# Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalogs
- [Back to Structron Documentation](./../_Structron.md)
- [Go to Catalogs.php](./../../src/Dto/UpdateCatalogs/Catalogs.php)

Holds a list of payment services.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\UpdateCatalogs\Catalog | Catalog |
| Wundii\AfterbuySdk\Enum\UpdateActionCatalogsEnum | UpdateActionCatalogsEnum |

## Properties
| Catalogs                    | Type                     | Default  | Description |
| --------------------------- | ------------------------ | -------- | ----------- |
| updateActionCatalogsEnum    | UpdateActionCatalogsEnum | required |             |
| **catalogs**                | Catalog[]                | []       |             |
| catalogs.catalogId          | int                      | null     |             |
| catalogs.catalogName        | string                   | null     |             |
| catalogs.catalogDescription | string                   | null     |             |
| catalogs.additionalUrl      | string                   | null     |             |
| catalogs.level              | int                      | null     |             |
| catalogs.position           | int                      | null     |             |
| catalogs.additionalText     | string                   | null     |             |
| catalogs.showCatalog        | bool                     | null     |             |
| catalogs.picture            | string                   | null     |             |
| catalogs.mouseOverPicture   | string                   | null     |             |
| **catalogs.catalog**        | Catalog[]                | []       |             |
