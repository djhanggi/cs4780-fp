a = read.table("classifications.txt", sep = "\t", header = TRUE)
cluster1 = subset(a, Cluster == "C1")
cluster2 = subset(a, Cluster == "C2")
cluster3 = subset(a, Cluster == "C3")
cluster4 = subset(a, Cluster == "C4")
cluster5 = subset(a, Cluster == "C5")
cluster6 = subset(a, Cluster == "C6")
cluster7 = subset(a, Cluster == "C7")
cluster8 = subset(a, Cluster == "C8")
cluster9 = subset(a, Cluster == "C9")
c1t = 0
for (i in (1:length(cluster1$Genre))){
  c1t = c1t + sapply(cluster1$Genre, function(x){sum(grepl(cluster1$Genre[i], x))})
}
c2t = 0
for (i in (1:length(cluster2$Genre))){
  c2t = c2t + sapply(cluster2$Genre, function(x){sum(grepl(cluster2$Genre[i], x))})
}

c2 = as.list(setNames(c2t, cluster2$Genre))

c3t = 0
for (i in (1:length(cluster3$Genre))){
  c3t = c3t + sapply(cluster3$Genre, function(x){sum(grepl(cluster3$Genre[i], x))})
}

c3 = as.list(setNames(c3t, cluster3$Genre))

c4t = 0
for (i in (1:length(cluster4$Genre))){
  c4t = c4t + sapply(cluster4$Genre, function(x){sum(grepl(cluster4$Genre[i], x))})
}

c4 = as.list(setNames(c4t, cluster4$Genre))

c5t = 0
for (i in (1:length(cluster5$Genre))){
  c5t = c5t + sapply(cluster5$Genre, function(x){sum(grepl(cluster5$Genre[i], x))})
}

c5 = as.list(setNames(c5t, cluster5$Genre))

c6t = 0
for (i in (1:length(cluster6$Genre))){
  c6t = c6t + sapply(cluster6$Genre, function(x){sum(grepl(cluster6$Genre[i], x))})
}

c6 = as.list(setNames(c6t, cluster6$Genre))

c7t = 0
for (i in (1:length(cluster7$Genre))){
  c7t = c7t + sapply(cluster7$Genre, function(x){sum(grepl(cluster7$Genre[i], x))})
}

c7 = as.list(setNames(c7t, cluster7$Genre))

c8t = 0
for (i in (1:length(cluster8$Genre))){
  c8t = c8t + sapply(cluster8$Genre, function(x){sum(grepl(cluster8$Genre[i], x))})
}
c8 = as.list(setNames(c8t, cluster8$Genre))
c9t = 0
for (i in (1:length(cluster9$Genre))){
  c9t = c9t + sapply(cluster9$Genre, function(x){sum(grepl(cluster9$Genre[i], x))})
}
c9 = as.list(setNames(c9t, cluster9$Genre))










