# Libraries toevoegen
import RPi.GPIO as GPIO
import Sensoren_Functies

# GPIO mode
GPIO.setmode(GPIO.BCM)

# Zet de GPIO pins
GPIO_TRIGGER1 = 6
GPIO_TRIGGER2 = 19
GPIO_TRIGGER3 = 16

GPIO_ECHO1 = 13
GPIO_ECHO2 = 26
GPIO_ECHO3 = 20

# Setup van de GPIO's
GPIO.setup(GPIO_TRIGGER1, GPIO.OUT)
GPIO.setup(GPIO_TRIGGER2, GPIO.OUT)
GPIO.setup(GPIO_TRIGGER3, GPIO.OUT)

GPIO.setup(GPIO_ECHO1, GPIO.IN)
GPIO.setup(GPIO_ECHO2, GPIO.IN)
GPIO.setup(GPIO_ECHO3, GPIO.IN)

# Lijst aanmaken waar alle pins in zitten met calibratie factor
GPIOlist = [[GPIO_TRIGGER1, GPIO_ECHO1, 0.969], [GPIO_TRIGGER2, GPIO_ECHO2, 0.930], [GPIO_TRIGGER3, GPIO_ECHO3, 0.956]]

# --------------------------------------------------------------------------------------------------------------

# Aantal variable toevoegen
meting = 10     # Hoeveel metingen er wordt gedaan voor 1 meting
inLijst = 4     # Hoe accuraat de gemeten waarde moet zijn
meting_sec = 10 # Na hoeveel seconden een nieuwe meting wordt gestart

try:
    # Kijk of de gebruiker de variable meting en inLijst verkeerd heeft ingesteld, zo ja wordt er hier een error gegeven
    if Sensoren_Functies.correct(meting, inLijst) or Sensoren_Functies.correct(meting, inLijst) is None:
        # Als de inLijst 40% van de meting zit wordt er een waarschuwing gegeven
        if Sensoren_Functies.correct(meting, inLijst) is None:
            print('De nu ingestelde opties hebben een gevolg op de snelheid van de container.')
            print('Verlaag variable inLijst zodat de metingen sneller verlopen.')

        # Calibratie functie en de meetfunctie aanroepen met de variable
        data = Sensoren_Functies.calibreren(meting, inLijst, GPIOlist)
        Sensoren_Functies.volume(meting, inLijst, GPIOlist, data, meting_sec)

    # Als de inLijst hoger is de meting dan geeft het script een error en stopt het automatisch
    else:
        print('-----------------------')
        print('De variable inLijst heeft een hogere waarde dan de variable meting!')
        print('meting : {}, inLijst : {}. Zorg dat meting >= inLijst waar blijft.'.format(meting, inLijst))
        GPIO.cleanup()

# Als je ergens in het script een
except KeyboardInterrupt:
    print('-----------------------')
    print('Gebruiker heeft container afgesloten.')
    GPIO.cleanup()
