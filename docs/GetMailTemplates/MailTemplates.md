# Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates
- [Back to Structron Documentation](./../_Structron.md)
- [Go to MailTemplates.php](./../../src/Dto/GetMailTemplates/MailTemplates.php)

Hold a list of mail templates.

## Class glossary
| FullObjectName | Object |
| -------------- | ------ |
| Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplate | MailTemplate |

## Properties
| MailTemplates                        | Type           | Default  | Description |
| ------------------------------------ | -------------- | -------- | ----------- |
| **mailTemplates**                    | MailTemplate[] | required |             |
| &nbsp; mailTemplates.templateId      | int            | required |             |
| &nbsp; mailTemplates.templateName    | string         | null     |             |
| &nbsp; mailTemplates.templateSubject | string         | null     |             |
| &nbsp; mailTemplates.templateText    | string         | null     |             |
| &nbsp; mailTemplates.templateHtml    | bool           | false    |             |
