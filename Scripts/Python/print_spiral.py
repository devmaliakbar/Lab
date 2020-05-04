data = [
	[1, 2, 3, 4, 5, 6, 7, 8, 9],
	[26, 27, 28, 29, 30, 31, 32, 33, 10],
	[25, 44, 45, 46, 47, 48, 49, 34, 11],
	[24, 43, 54, 53, 52, 51, 50, 35, 12],
	[23, 42, 41, 40, 39, 38, 37, 36, 13],
	[22, 21, 20, 19, 18, 17, 16, 15, 14],
]

# Reversing a list using reverse()
def rev(lst):
	lst.reverse()
	return lst


def print_array(data):
	for dat in data:
		print(dat)


def print_spiral(data):
	print_array(data[0])
	next_data = data[1:][:-1]
	for rows in data[1:][:-1]:
		print(rows[-1])
	last_row = rev(data[-1])
	print_array(last_row)
	rev_next_data = rev(next_data)
	for rows in rev_next_data:
		print(rows[0])
	next_data.reverse()
	next_array = []
	for dat in next_data:
		next_array.append(dat[1:-1])
	return next_array

def driver():
	next_data = print_spiral(data)
	while next_data:
		next_data = print_spiral(next_data)

driver()