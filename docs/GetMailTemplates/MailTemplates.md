# Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplates
- [Back to Structron Documentation](/var/www/afterbuy-sdk/docs//_Structron.md)
- [Go to MailTemplates.php](/var/www/afterbuy-sdk/src/Dto/GetMailTemplates/MailTemplates.php)

Hold a list of mail templates.

| MailTemplates                        | Type                                                   | Default  | Description |
| ------------------------------------ | ------------------------------------------------------ | -------- | ----------- |
| **mailTemplates**                    | Wundii\AfterbuySdk\Dto\GetMailTemplates\MailTemplate[] | required |             |
| &nbsp; mailTemplates.templateId      | int                                                    | required |             |
| &nbsp; mailTemplates.templateName    | string                                                 | null     |             |
| &nbsp; mailTemplates.templateSubject | string                                                 | null     |             |
| &nbsp; mailTemplates.templateText    | string                                                 | null     |             |
| &nbsp; mailTemplates.templateHtml    | bool                                                   | false    |             |
