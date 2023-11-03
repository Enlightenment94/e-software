import re

def validate(string):
    #string = "13662639310:734,00 zł:Nowy"  # przykładowy ciąg
    #string = "13662639310:734,00 zł:Używany"  # przykładowy ciąg
    #string = "13662639310::Używany"  # przykładowy ciąg

    # wyrażenie regularne, które szuka końcówki ":liczba zł"
    regex = r"[0-9]+:[0-9]+,[0-9]+ zł:(Nowy|Używany)$"

    if re.search(regex, string):
        print("Cena jest poprawna")
        return 1;
    else:
        print("Błąd formy ceny")
        return 0;