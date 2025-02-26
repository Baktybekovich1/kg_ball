#!/bin/sh

# Convert env variable to lowercase
get_certs_lower=$(echo "$GET_CERTS" | tr '[:upper:]' '[:lower:]')

# Check lowercase value of env variable
if [ "$get_certs_lower" = "true" ]; then

    folder_path="/etc/letsencrypt/live/$DOMAIN"
    # If path exists then let certbot rewrite nginx config
    if [ -d "$folder_path" ]; then
        certbot -n --nginx -d "$DOMAIN"
        nginx -s stop
        # Need time for stop
        sleep 2
    # Else get certs and rewrite nginx config
    else
        certbot --nginx --email "$CERTBOT_EMAIL" --agree-tos --no-eff-email -d "$DOMAIN"
        nginx -s stop
        sleep 2
    fi

fi