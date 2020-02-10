import sys, os, re
playerList = []
playerNameSet = set()
class player:
	hits = 0
	ABs = 0
	avg = 0;

	def __init__(self, name):
		#Initializes the data.
		self.name = name
		
	def __iter__(self):  #iterable code from https://stackoverflow.com/questions/40923522
	#/python-defining-an-iterator-class-failed-with-iter-returned-non-iterator-of?rq=1
		self.a = 0
		self.b = 1
		return self

	def __next__(self):
		player = self.a
		if player > self.max:
			raise StopIteration
		self.a, self.b = self.b, self.a + self.b
		return player

	def addHits(self,newHits): 
	#add hits to a player
		self.hits += newHits	

	def addABs(self,newABs): 
	#add at bats to a player
		self.ABs += newABs
		
	def calcAvg(self):
	#calc average for a player
		self.avg = self.hits/self.ABs
		return self.avg
	def getABs(self):
		return self.ABs
		
	def getHits(self):
		return self.Hits
		
	def getAvg(self):
		return self.avg

namePattern = re.compile(r"^[A-Z].+[A-Z].*?\b")
ABpattern = re.compile(r"(?<=batted\s)\d(?=\stimes)")
hitPattern = re.compile(r"(?<=with\s)\d(?=\shits)")


#import file from terminal 
if len(sys.argv) < 2:
	sys.exit(f"Usage: {sys.argv[0]} filename - input file must be enteredx ")
	
	filename = sys.argv[1]
	
	if not os.path.exists(filename):
		sys.exit(f"Error: File '{sys.argv[1]}' not found")
filename = sys.argv[1]

with open(filename) as f:
	for line in f:
		playerName = namePattern.search(line)
		playerHits = hitPattern.search(line)
		playerABs = ABpattern.search(line)
		if playerName:
			name = namePattern.findall(line)[0]
			if name not in playerNameSet:
				playerNameSet.add(name)
				newPlayer = player(name) 
				playerList.append(newPlayer)
		
		if playerABs: 
			for i, players in enumerate(playerList):
				if playerList[i].name == name:
					numABs = int(ABpattern.findall(line)[0])
					#print(playerList[i].name)
					#print(playerList[i].ABs)
					playerList[i].addABs(numABs)
		if playerHits: 
			for i, players in enumerate(playerList):
				if playerList[i].name == name:
					numHits = int(hitPattern.findall(line)[0])
					#print(playerList[i].name)
					#print(playerList[i].ABs)
					playerList[i].addHits(numHits)
			
sortedPlayers = sorted(playerList, key = lambda player: player.calcAvg(),reverse=True)
for i, players in enumerate(sortedPlayers):
	print("{}: {:.3f}".format(sortedPlayers[i].name,round(sortedPlayers[i].calcAvg(),3)))
	
	