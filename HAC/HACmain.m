addpath HAC/jsonlab

songData = SongParser.parseSongData('DataParsing/csv/all_songs-modified.csv');

dist = zeros(length(songData));
for r = 1:length(songData)
    for c = r+1:length(songData)
        dist(r, c) = Song.distance(songData(r), songData(c));
        dist(c, r) = Song.distance(songData(r), songData(c));
    end
end

squareDist = squareform(dist);

linkSingle = linkage(squareDist, 'single');
clustersSingle = Cluster.agglomerate(songData, linkSingle);
fid = fopen('HAC/all-songs-clustering-single.json', 'w');
fprintf(fid, clustersSingle(end).outputClusterJSON());
fclose(fid);

linkComple = linkage(squareDist, 'complete');
clustersComple = Cluster.agglomerate(songData, linkComple);
fid = fopen('HAC/all-songs-clustering-complete.json', 'w');
fprintf(fid, clustersComple(end).outputClusterJSON());
fclose(fid);

linkAverag = linkage(squareDist, 'average');
clustersAverag = Cluster.agglomerate(songData, linkAverag);
fid = fopen('HAC/all-songs-clustering-average.json', 'w');
fprintf(fid, clustersAverag(end).outputClusterJSON());
fclose(fid);

linkCentro = linkage(squareDist, 'centroid');
clustersCentro = Cluster.agglomerate(songData, linkCentro);
fid = fopen('HAC/all-songs-clustering-centroid.json', 'w');
fprintf(fid, clustersCentro(end).outputClusterJSON());
fclose(fid);
