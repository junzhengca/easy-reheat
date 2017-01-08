import os

import sys
from clarifai.rest import ClarifaiApp
from clarifai.rest import Image as ClImage
warning_item = ['recycling', 'bag', 'trash', 'garbage',
           'kitchenware', 'knife', 'steel',
           'stainless steel', 'fork', 'spoon']
os.environ["HOME"] = "/root"

"""
Microwave-time

Receive a URL of a picture from back-end, return what kind of
food is in the pic
"""

class Food:
    """
    A photo of food

    === Attributes ===
    @type url_address: str
        the url of the picture
    """
    def __init__(self, address):
        """Initialize a new Food.

        Creat Food.

        @type self: Food
        @type address: str
        @rtype: None
        """
        self.url_address = address

    def check_warning(self):
        """
        Check if there is anything cann't go in microwave

        @type self: Food
        @rtype: bool
        """
        app = ClarifaiApp("Hr3f_TNV3d26DFexmloW62wVwZc2Cc4MoTkN7d7P", "vqmlJn5xUE1ZhmDcyw9nrDNMqTNq7NKrgue9YPxm")
        general = app.models.get('general-v1.3')
        image = ClImage(url=self.url_address)

        result = general.predict([image])
        consider_result = {}

        for item in result['outputs'][0]['data']['concepts']:
            if item['value'] > 0.7:
                consider_result[item['name']] = item['value']

        for item in consider_result:
            if item in warning_item:
                return False

        return True

    def check_food(self):
        """
        Check what is in the food

        @type self: Food
        @rtype: dict
        """
        app = ClarifaiApp("Hr3f_TNV3d26DFexmloW62wVwZc2Cc4MoTkN7d7P", "vqmlJn5xUE1ZhmDcyw9nrDNMqTNq7NKrgue9YPxm")
        fod = app.models.get('food-items-v1.0')
        image = ClImage(url=self.url_address)

        result = fod.predict([image])
        consider_result = {}

        for item in result['outputs'][0]['data']['concepts']:
            consider_result[item['name']] = item['value']

        return consider_result


if __name__ == '__main__':
    pic = sys.argv[1]

    f = Food(pic)
    if f.check_warning():
        print(0)
    else:
        print(1)

    r = f.check_food()

    for i in r:
        print(i + "/" + str(r[i]))
