while true
do
  pkill -f firefox-bin
  python3 main.py
  time=$(shuf -i 12-35 -n 1)
  sleep $time
  echo "Bash $time sekund."
done
