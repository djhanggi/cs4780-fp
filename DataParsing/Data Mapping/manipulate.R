setwd("Desktop/CS478final")

tdance0_1 = read.csv("dance_0to1_data.csv", header = TRUE)
tdance1_2 = read.csv("dance_1to2_data.csv")
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

#fill in NA data with mean: 
for(i in 1:length(speechiness)){
  if(is.na(speechiness[i])){
    speechiness[i] = summary(speechiness)["Mean"]
  }
}

for(i in 1:length(instrumentalness)){
  if(is.na(instrumentalness[i])){
    instrumentalness[i] = summary(instrumentalness)["Mean"]
  }
}

dance$speechiness = speechiness
dance$instrumentalness = instrumentalness

#find correlations among variables in the data
correlations = cor(dance[,c("key","energy","liveness", "tempo", "speechiness", "acousticness", "instrumentalness", "mode", 
                            "time_signature", "duration", "loudness", "valence", "danceability")])

plot(-3.279225e-06*danceability*I(tempo^2) +  -8.160651e-04*energy*I(loudness^2) +  
       3.218223e-01*acousticness*I(energy^2)+-3.279225e-06*liveness*speechiness
     +3.793979e-04*tempo*energy+-7.492498e-03*loudness*acousticness
     + 7.001209e-02*instrumentalness*danceability+ -6.132415e-04*valence*loudness
     +1.359087e-02*energy*loudness*I(danceability^2), valence, pch =16)

plot(-3.279225e-06*valence*I(tempo^2) +  -8.160651e-04*energy*I(loudness^2) +  
       3.218223e-01*acousticness*I(energy^2)+-3.279225e-06*liveness*speechiness
     +3.793979e-04*tempo*energy+-7.492498e-03*loudness*acousticness
     + 7.001209e-02*instrumentalness*valence+ -6.132415e-04*valence*loudness
     +1.359087e-02*energy*loudness*I(valence^2), danceability, pch =16)

plot(-0.3126570*acousticness +   0.0007503*tempo + 0.0171926*loudness + 0.1399756*valence + -0.0295041*danceability
      +0.2433880*speechiness +  0.0186821*loudness*danceability, 
      energy, pch =16)


