# Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates
- [Back to Structron Documentation](./../_Structron.md)
- [Go to MailTemplates.php](./../../src/Dto/GetMailTemplates/MailTemplates.php)

Hold a list of mail templates.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplate | MailTemplate |

## Properties
| MailTemplates                 | Type           | Default  | Description |
| ----------------------------- | -------------- | -------- | ----------- |
| **mailTemplates**             | MailTemplate[] | required |             |
| mailTemplates.templateId      | int            | required |             |
| mailTemplates.templateName    | string         | null     |             |
| mailTemplates.templateSubject | string         | null     |             |
| mailTemplates.templateText    | string         | null     |             |
| mailTemplates.templateHtml    | bool           | false    |             |
