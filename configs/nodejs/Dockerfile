FROM node:14.11.0-alpine3.12

#RUN apk update && apk upgrade && apk add --no-cache gcc g++ make

RUN apk add --no-cache python2 && \
    python -m ensurepip && \
    rm -r /usr/lib/python*/ensurepip && \
    pip install --upgrade pip setuptools && \
    rm -r /root/.cache


#RUN npm install -g @angular/cli
#RUN cd log-front
#RUN ng serve -c my

#EXPOSE 4200

WORKDIR /var/www/front

#COPY boot.sh /usr/local/bin/boot

#CMD ["sh", "/usr/local/bin/boot"]
