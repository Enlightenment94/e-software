#!/bin/bash

while true
do
  pkill -f firefox-bin
  PYTHONUNBUFFERED=1 
  result="init"
  result=$(python3 -u main.py | tee /dev/tty)
  echo $result
  # wylosuj liczbe od 30 do 120
  time=$(shuf -i 12-35 -n 1)

  # ustaw czas
  sleep $time

  # wyswietl komunikat
  echo "Bash $time sekund."
done
