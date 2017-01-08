red_meat_file = open('red_meat.txt', 'r')
red_meat_list = red_meat_file.readlines()
red_meat_file.close()
green_vegtables_file = open('green_vegtables.txt', 'r')
green_vegtables_list = green_vegtables_file.readlines()
green_vegtables_file.close()
roots_vegtables_file = open('roots_vegtables.txt', 'r')
roots_vegtables_list = roots_vegtables_file.readlines()
roots_vegtables_file.close()
grains_file = open('grains.txt', 'r')
grains_list = grains_file.readlines()
grains_file.close()
fruits_file = open('fruits.txt', 'r')
fruits_list = fruits_file.readlines()
fruits_file.close()
fish_file = open('fish.txt', 'r')
fish_list = fish_file.readlines()
fish_file.close()
shelfish_file = open('shelfish.txt', 'r')
shelfish_list = shelfish_file.readlines()
shelfish_file.close()
dairy_file = open('dairy.txt', 'r')
dairy_list = dairy_file.readlines()
dairy_file.close()
drinks_file = open('drinks.txt', 'r')
drinks_list = drinks_file.readlines()
drinks_file.close()

food_list = list(my_dict.keys())
percentage_list = []
for each_element in food_list:
    percentage_list.append(my_dict[each_element])

new_food_list = food_list[0:4]
new_percentage_list = percentage_list[0:4]

times = []

for next_food in new_food_list:
    if next_food in red_meat_list:
        times.append(60) 
    elif next_food in green_vegtables_list:
        times.append(30) 
    elif next_food in grains_list:
        times.append(40) 
    elif next_food in fruits_list:
        times.append(20) 
    elif next_food in drinks_list:
            times.append(20)
    elif next_food in roots_vegtables_list:
            times.append(20)
    elif next_food in fish_list:
            times.append(20)
    elif next_food in shelfish_list:
            times.append(20)
    elif next_food in dairy_list:
            times.append(20)
    else:
        times.append(30)

microwave_times = []
index = 0
for next_percentage in new_percentage_list:
    microwave_times.append(next_percentage * times[index])
    index += 1

percentage_sum = sum(new_percentage_list)
microwave_time_sum = sum(microwave_times)
ideal_time = microwave_time_sum/percentage_sum
print('You should microwave the food ' + ideal_time)