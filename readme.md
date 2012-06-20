# Decres

Welkom bij Decres. Decres is een PHP compressor engine. Dit betekend dat je met Decres je scriptbestanden kunt compresseren. Decres is zeer makkelijk uit te bouwen, waardoor je zelf je eigen compressors kunt maken. Hierdoor werkt het altijd zoals jij het wilt.

## Download

Decres kun je downloaden door de recentste download te kiezen van de [Download pagina](https://github.com/WouterJ/Decres/tags).

Een andere optie is door deze Repository te clonen, hiervoor heb je GIT nodig:

    git clone http://github.com/WouterJ/Decres.git

Nu zal er een map Decres worden aangemaakt op de plaats die je hebt aangegeven.

### Eerste keer

Voordat je met Decres aan de slag kunt moet je de map waarin het Decres project staat aan je omgevingsvariabele toevoegen. Dit doe je door `Computer > Eigenschappen > Geavanceerde systeeminstellingen > Geavanceerd > Omgevingsvariabelen > Path > bewerken` en dan `; C:\path\to\Decres` toe te voegen.

> **Opmerking**
> Aangezien Decres nu nog in de Alpha fase zit zal je zelf naar `Decres/decres.bat` moeten gaan en daar het path naar decres.php aanpassen, op de laatste lijn achter `"%PHPBIN%" "`. Ook het path naar PHP (`PHPBIN=` op lijn 2) zal je zelf moeten aanpassen.
> Als je op een Linux of Mac computer zit moet je niet het bat bestand maar `decres.php` aanpassen, het path achter `#!` op de eerste lijn.

## Meehelpen

Heb je een fout ontdekt, of zou je graag iets willen zien (bijv. een nieuwe compressor)? Dan kun je dat aangeven in [het issues gedeelte](https://github.com/WouterJ/Decres/issues).

Heb je zelf al een compressor geschreven en wil je die aan dit project toevoegen? Of heb je je eigen fout weten op te lossen door de broncode te bewerken? In dat geval kun je via Github en GIT dit project forken, aanpassen en dan een Pull Request aanvragen.
