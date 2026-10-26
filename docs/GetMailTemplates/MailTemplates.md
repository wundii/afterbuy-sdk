# Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates
- [Back to Structron Documentation](./../_Structron.md)
- [Go to MailTemplates.php](./../../src/Dto/GetMailTemplates/MailTemplates.php)

Hold a list of mail templates.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplate | MailTemplate |

## Properties
| MailTemplates                 | Type           | Default  | Description                                                                                                                                       |
| ----------------------------- | -------------- | -------- | ------------------------------------------------------------------------------------------------------------------------------------------------- |
| **mailTemplates**             | MailTemplate[] | required |                                                                                                                                                   |
| mailTemplates.templateId      | int            | required |                                                                                                                                                   |
| mailTemplates.templateName    | string         | null     |                                                                                                                                                   |
| mailTemplates.templateSubject | string         | null     | Only returned with DetailLevel 2                                                                                                                  |
| mailTemplates.templateText    | string         | null     | Raw mail content with unresolved Afterbuy variables; only returned with DetailLevel 2. Use GetTranslatedMailTemplate to resolve them for an order |
| mailTemplates.templateHtml    | bool           | false    |                                                                                                                                                   |
