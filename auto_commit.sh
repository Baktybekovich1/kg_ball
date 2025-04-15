#!/bin/bash

# Путь к вашему Symfony проекту


# Файл, в который будем вносить изменения
DUMMY_FILE="last_commit.log"

# Переход в директорию проекта
cd $PROJECT_PATH || exit

# Внесение фиктивных изменений
echo "Последний коммит: $(date '+%Y-%m-%d %H:%M:%S')" > $DUMMY_FILE

# Проверка на наличие изменений
if [[ -n $(git status --porcelain) ]]; then
    echo "Обнаружены изменения. Выполняю коммит и push."

    # Добавить изменения
    git add -A

    # Создать коммит
    git commit -m "Автоматический коммит: $(date '+%Y-%m-%d %H:%M:%S')"

    # Отправить изменения в удалённый репозиторий
    git push origin main
else
    echo "Нет изменений для коммита."
fi
