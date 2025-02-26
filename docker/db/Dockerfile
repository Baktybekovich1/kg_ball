FROM postgres:12

# Install dependencies
#RUN apt-get update && apt-get -y -qq --no-install-recommends install \
#    ca-certificates \
#    curl \
#    gnupg \
#    make \
#    libpq-dev && \
#    update-ca-certificates && \
#    curl -sSL https://www.postgresql.org/media/keys/ACCC4CF8.asc | apt-key add - && \
#    echo "deb http://apt.postgresql.org/pub/repos/apt bullseye-pgdg main" > /etc/apt/sources.list.d/pgdg.list && \
#    apt-get update && apt-get -y -qq --no-install-recommends install postgresql-server-dev-13

RUN apt-get update \
&& apt-get -y -qq --no-install-recommends install  \
    make \
    libpq-dev \
    postgresql-server-dev-12
