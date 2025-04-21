#!/bin/bash

# Перейти в директорию проекта
cd /path/to/your/project

# Внести изменения (например, добавить временную метку в файл)
echo "# Updated on $(date)" >> README.md

# Добавить изменения в Git
git add .

# Закоммитить изменения
git commit -m "Automated commit on $(date)"

# Отправить изменения на GitHub
git push origin main
