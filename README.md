## TRMNL Train Monitor

## Description
This is a TRMNL plugin that monitors the status of trains.

Supported train companies:
- ÖBB (Austria)

### Environment Variables

| Variable                       | Description                               | Default                | Examples                                                                                           |
|--------------------------------|-------------------------------------------|------------------------|----------------------------------------------------------------------------------------------------|
| `TRMNL_PLUGIN_TYPE`            | Plugin Type                               | `private`              | `public`, `private`                                                                                |
| `TRMNL_DATA_STRATEGY`          | Data Strategy                             | `polling`              | `polling` , `webhook`                                                                              |
| `TRMNL_WEBHOOK_URL`            | Webhook URL                               | `null`                 | `https://usetrmnl.com/api/custom_plugins/{{$uuid}}`                                                |
| `OEBB_STATION_ID`              | ÖBB Station ID                            | `8101590`              | Default Vienna Main Station. Grab your station id from https://fahrplan.oebb.at/bin/stboard.exe/dn |
| `OEBB_STATION_NAME`            | ÖBB Station Name                          | `Wien Hbf. (Bst. 1-2)` |                                                                                                    |
| `OEBB_HIDDEN_TRACKS`           | Tracks that should be hidden from monitor | `null`                 | `1,2,3`                                                                                            |
| `OEBB_SCHEDULE_OFFSET_MINUTES` | Schedule offset in minutes                | `15`                   |                                                                                                    |
| `OEBB_REFRESH_EVERY_MINUTES    | Refresh schedule data every minutes       | `15`                   |                                                                                                    |

## Getting started

### Environment
* Copy .env.example to .env

```bash
cp .env.example .env
```

### Docker

#### Docker Compose
```bash
 docker compose up  
```

#### Pure Docker
```bash
 docker build -t trmnl-oebb-monitor .  
```
```bash
docker run -p 8080:8080 --name trmnl-oebb-monitor trmnl-oebb-monitor:latest 
docker exec -it trmnl-oebb-monitor php artisan key:generate
```
