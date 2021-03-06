# Общая организация пакета WEB_APP. Наиболее значимые компоненты
## Описание
WEB_APP позволяет стоить веб-приложения, применяя паттерн MVC (Model-View-Controller). Сам WEB_APP пакет предоставляет классы для реализации только Controller составляющей. Выбор средства для реализации модели и отображения все равно лежит на конечном разработчике приложения, хотя WEB_APP реализован таким образом чтобы максимально упростить работу с приложениями, где в качестве модели будут выбраны «родные» Limb3 пакеты DBAL и ACTIVE_RECORD, а в качестве отображения — пакет VIEW.

**Ядро** Limb3-приложения строится обычно на основе **цепочки фильтров**, которая запускается из файла index.php. Цепочка фильтров стоится из набора типовых фильтров пакета WEB_APP, которые можно найти в папке /limb/web_app/src/filter или из тех, которые сочтет нужными реализовать конечный разработчик приложения.

## Структура папок пакета WEB_APP

Папка | Описание
------|---------
controller/ | Реализация [Контроллера](./controller.md).
filter/	| Наиболее часто используемые [фильтры](./architecture.md), из которых создается ядро Limb3-based приложения. Front-controller в приложениях, созданных на базе Limb3, обычно реализуется в виде цепочки фильтров.
request/ | Содержит классы для разбора запроса и определения, что именно должно выполнить Limb3-приложение.
request/ | Классы для [разбора запроса](./request_dispatching.md), то есть получение необходимых параметров из строки запроса и определения, что конкретно должно сделать приложение о ответ на действие пользователя. В настоящее время содержит в частности [класс lmbRoutes](./lmb_routes.md), который позволяет устроить [разбор запроса (request dispatching)](./request_dispatching.md), аналогичный используемому в Rails.
template/	| Классы, расширяющие [шаблонную систему MACRO](../../../../macro/docs/ru/macro.md). В основном это [теги](../../../../macro/docs/ru/macro/tags.md) и [фильтры](../../../../macro/docs/ru/macro/filters.md), применяемые в Limb3-based приложениях.
toolkit/ | Содержит инструментарий пакета в виде [класса lmbWebAppTools](./lmb_web_app_tools.md). см. также описание [пакета TOOLKIT](../../../../toolkit/docs/ru/toolkit.md).
util/	| Различные утилитарные классы, например, [lmbMessageBox](./lmb_message_box.md), который используется для отображения сообщений пользователям.
