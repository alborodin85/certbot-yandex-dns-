# certbot-yandex-dns
php-скрипт получения wildcard-сертификатов certbot с помощью yandex-dns-api

Требует для работы программы: php, certbot, openssl, dig


## Возможное дальнейшее развитие:
- сделать settings.example.json
- сформировать phar-архив
- реконфигурировать папки проекта, чтобы можно было автоматически использовать phar
- сделать возможность указывать произвольное имя файла конфига
- вынести все фразы в файлы локализаций
- дописать подробнее данное README.md
- разнести папки по отдельным composer-компонентам, где это уместно
- у HttpRequestWrapper сделать возможность работать с асинхронными curl-запросами
- дописать страницу на сайте composer
- сделать отдельный composer-компонент с общим кодом для коллекций и элементов коллекций
- если один из доменов вылетает с ошибкой, то процесс обновления останавливается и остальные даже не начнут обновляться
