setwd("~/Desktop/CS478final/DataParsing/csv")

tdance0_1 = read.csv("dance_0to1_data.csv", header = TRUE)
tdance1_2 = read.csv("dance_1to2_data.csv", header = TRUE)
tdance2_3 = read.csv("dance_2to3_data.csv", header = TRUE)
tdance3_4 = read.csv("dance_3to4_data.csv", header = TRUE)
tdance4_5 = read.csv("dance_4to5_data.csv", header = TRUE)
tdance5_6 = read.csv("dance_5to6_data.csv", header = TRUE)
tdance6_7 = read.csv("dance_6to7_data.csv", header = TRUE)
tdance7_8 = read.csv("dance_7to8_data.csv", header = TRUE)
tdance8_9 = read.csv("dance_8to9_data.csv", header = TRUE)
tdance9_10 = read.csv("dance_9to10_data.csv", header = TRUE)

yd = merge(tdance5_6,tdance6_7,by=names(tdance0_1), all = TRUE)
yd = merge(tdance7_8,yd,by=names(tdance0_1), all = TRUE)
yd = merge(tdance8_9,yd,by=names(tdance0_1), all = TRUE)
yd = merge(tdance9_10,yd,by=names(tdance0_1), all = TRUE)

nodance = merge(tdance0_1,tdance1_2,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance2_3,nodance,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance3_4,nodance,by=names(tdance0_1), all = TRUE)
nodance = merge(tdance4_5,nodance,by=names(tdance0_1), all = TRUE)

dance = merge(yd, nodance, by = names(yd), all = TRUE)

attach(dance)
plot(-3.279225e-06*valence*I(tempo^2) +  -8.160651e-04*energy*I(loudness^2) +
=======
#updating NA values in instrumentalness 
for(i in 1:length(dance$speechiness)){
  if(is.na(dance$speechiness[i])){
    dance$speechiness[i] = 0.10720
  }
}

for(i in 1:length(dance$instrumentalness)){
  if(is.na(dance$instrumentalness[i])){
    dance$instrumentalness[i] = 0.319900
  }
}

write.csv(file="no_na_songs.csv", x=dance)

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

plot((-3.126570 * 10^-1)*acousticness
  +  (-7.503000 * 10^-4) * tempo
     +   (1.719260 * 10^-2) * loudness
     +  (-1.399756 * 10^-1) * valence
     +   (2.950410 * 10^-2) * danceability
     +  (-2.433880 * 10^-1) * speechiness
     +   (1.868210 * 10^-2) * loudness * danceability
     , energy, pch = 16)
