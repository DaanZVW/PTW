# Libraries
import RPi.GPIO as GPIO
import time

# GPIO Mode (BOARD / BCM)
GPIO.setmode(GPIO.BCM)

# set GPIO Pins
GPIO_TRIGGER1 = 16
GPIO_TRIGGER2 = 20
GPIO_TRIGGER3 = 21

GPIO_ECHO1 = 13
GPIO_ECHO2 = 19
GPIO_ECHO3 = 26

GPIO_INFRARED = 6

# set GPIO direction (IN / OUT)
GPIO.setup(GPIO_TRIGGER1, GPIO.OUT)
GPIO.setup(GPIO_TRIGGER2, GPIO.OUT)
GPIO.setup(GPIO_TRIGGER3, GPIO.OUT)

GPIO.setup(GPIO_ECHO1, GPIO.IN)
GPIO.setup(GPIO_ECHO2, GPIO.IN)
GPIO.setup(GPIO_ECHO3, GPIO.IN)

GPIO.setup(GPIO_INFRARED, GPIO.IN)

GPIOlist = [[GPIO_TRIGGER1, GPIO_ECHO1], [GPIO_TRIGGER2, GPIO_ECHO2], [GPIO_TRIGGER3, GPIO_ECHO3]]


def distance(sensor):
    # set Trigger to HIGH
    GPIO.output(GPIOlist[sensor][0], True)

    # set Trigger after 0.01ms to LOW
    time.sleep(0.00001)
    GPIO.output(GPIOlist[sensor][0], False)

    StartTime = time.time()
    StopTime = time.time()

    # save StartTime
    while GPIO.input(GPIOlist[sensor][1]) == 0:
        StartTime = time.time()

    # save time of arrival
    while GPIO.input(GPIOlist[sensor][1]) == 1:
        StopTime = time.time()

    # time difference between start and arrival
    TimeElapsed = StopTime - StartTime
    # multiply with the sonic speed (34300 cm/s)
    # and divide by 2, because there and back
    distance = (TimeElapsed * 34300) / 2

    return distance


def meten(loop):
    disttotal = []

    for j in range(0, 3):
        i = loop + 1
        dist = []

        while i != 0:
            dist.append(round(distance(j), 1))
            i -= 1
            time.sleep(0.5)

        disttotal.append(dist[1:])
        time.sleep(1)
        print("Meting {} gedaan... ".format(j + 1))

    return disttotal


def meet_afstand(loop=10):
    disttotal = meten(loop)

    for q in range(0, 3):
        dist = disttotal[q]

        freq = []
        for data in dist:
            j = 0
            for i in range(0, len(dist)):
                if data == dist[i]:
                    j += 1
            freq.append(j)

        print("Gemeten afstand = {0:.0f} cm".format(dist[freq.index(max(freq))]))
        print(time.strftime("%H:%M:%S"))


if __name__ == '__main__':
    try:
        wachten = 5

        print('Sensoren Calibreren...')
        time.sleep(2)
        print('Sensoren Actief...')
        while True:
            if GPIO.input(GPIO_INFRARED):
                print('Beweging Gedetecteerd...')
                print('Meting Begint Over {} Seconden'.format(wachten))
                time.sleep(wachten)
                print('Meting Begonnen...')
                meet_afstand(10)
                time.sleep(5)
                print('Sensoren Actief...')

        # Reset by pressing CTRL + C
    except KeyboardInterrupt:
        print("Meting gestopt door gebruiker.")
        GPIO.cleanup()

    except:
        print("Er is een Error ontstaan.")
        GPIO.cleanup()
