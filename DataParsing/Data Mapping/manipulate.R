setwd("Desktop/CS478final")

tdance0_1 = read.csv("dance0_1.csv", header = TRUE)
tdance1_2 = read.csv("dance1_2.csv")
tdance2_3 = read.csv("dance2_3.csv", header = TRUE)
tdance3_4 = read.csv("dance3_4.csv", header = TRUE)
tdance4_5 = read.csv("dance4_5.csv", header = TRUE)
tdance5_6 = read.csv("dance5_6.csv", header = TRUE)
tdance6_7 = read.csv("dance6_7.csv", header = TRUE)
tdance7_8 = read.csv("dance7_8.csv", header = TRUE)
tdance8_9 = read.csv("dance8_9.csv", header = TRUE)
tdance9_10 = read.csv("dance9_10.csv", header = TRUE)

yd = merge(tdance5_6,tdance6_7,by=names(tdance0_1), all = TRUE)
yd = merge(tdance7_8,yd,by=names(tdance0_1), all = TRUE)
yd = merge(tdance8_9,yd,by=names(tdance0_1), all = TRUE)
yd = merge(tdance9_10,yd,by=names(tdance0_1), all = TRUE)

nodance = merge(tdance0_1,tdance1_2,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance2_3,nodance,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance3_4,nodance,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance4_5,nodance,by=names(tdance0_1), all = TRUE)

dance = merge(yd, nodance, by = names(yd), all = TRUE)

plot(-3.279225e-06*valence*I(tempo^2) +  -8.160651e-04*energy*I(loudness^2) +  
       3.218223e-01*acousticness*I(energy^2)+-3.279225e-06*liveness*speechiness
     +3.793979e-04*tempo*energy+-7.492498e-03*loudness*acousticness
     + 7.001209e-02*instrumentalness*valence+ -6.132415e-04*valence*loudness
     +1.359087e-02*energy*loudness*I(valence^2), valence, pch =16)

plot(-3.279225e-06*valence*I(tempo^2) +  -8.160651e-04*energy*I(loudness^2) +  
       3.218223e-01*acousticness*I(energy^2)+-3.279225e-06*liveness*speechiness
     +3.793979e-04*tempo*energy+-7.492498e-03*loudness*acousticness
     + 7.001209e-02*instrumentalness*valence+ -6.132415e-04*valence*loudness
     +1.359087e-02*energy*loudness*I(valence^2), danceability, pch =16)



