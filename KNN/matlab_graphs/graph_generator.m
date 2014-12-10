num_songs = [100, 200, 400, 800, 1600, 3200, 7200];

execution_time_nt = [1.5421421527863, 3.3868300914764, 7.6780619621277, 17.305434942245, 42.267510175705, 94.326319932938, 242.54957103729];

dance_error_nt = [0.14438796918336, 0.14203315192604, 0.14028161304571, 0.14059104211608, 0.13756684427324, 0.13679652747817, 0.1352916296867];

valence_error_nt = [0.21533687591166, 0.21094385351823, 0.20450989707242, 0.20702997205958, 0.20986023133025, 0.20795446563945, 0.20675517226502];

energy_error_nt = [0.18904953559322, 0.1763389336415, 0.15226851607601, 0.14240337514124, 0.13713657051875, 0.13286444591679, 0.12591201397021];

execution_time_t = [1.6212060451508, 3.5367131233215, 7.8259379863739, 18.290140151978, 41.356256008148, 99.527333021164, 262.38856887817];

dance_error_t = [0.1519393767848, 0.15214811607601, 0.1526277470981, 0.14817181520288, 0.14948463965074, 0.14773315007704, 0.14680489286081];

energy_error_t = [0.21326138222907, 0.21505618233179, 0.21209696548536, 0.20842041407293, 0.20863805577812, 0.21172022496148, 0.21001826255778];

valence_error_t = [0.21821632316384, 0.21757294812532, 0.21948835048793, 0.21734048094504, 0.21552887539805, 0.21625192039034, 0.21466223965074];

%% Plot Execution Times
figure
axis([0, 7500, 0, 250])
hold on

title('Execution Time of kNN Implementation')
xlabel('Number of Training Samples')
ylabel('Execution Time')
plot(num_songs, execution_time_nt, 'b-', num_songs, execution_time_t, 'r-')
legend({'No Transformation','With Transformation'},'FontSize',8,'FontWeight','bold')
saveas(gcf,'execution_time', 'png')

hold off

%% Plot Danceability Prediction Errors
figure
axis([0, 7500, 0, .3])
hold on

title('Danceability Prediction Error')
xlabel('Number of Training Samples')
ylabel('Prediction Error')
plot(num_songs, dance_error_nt, 'b-', num_songs, dance_error_t, 'r-')
legend({'No Transformation','With Transformation'},'FontSize',8,'FontWeight','bold')
saveas(gcf,'danceability_error', 'png')
hold off

%% Plot Valence Prediction Errors
figure
axis([0, 7500, 0, .3])
hold on

title('Valence Prediction Error')
xlabel('Number of Training Samples')
ylabel('Prediction Error')
plot(num_songs, valence_error_nt, 'b-', num_songs, valence_error_t, 'r-')
legend({'No Transformation','With Transformation'},'FontSize',8,'FontWeight','bold')
saveas(gcf,'valence_error', 'png')
hold off

%% Plot Energy Prediction Errors
figure
axis([0, 7500, 0, .3])
hold on

title('Energy Prediction Error')
xlabel('Number of Training Samples')
ylabel('Prediction Error')
plot(num_songs, energy_error_nt, 'b-', num_songs, energy_error_t, 'r-')
legend({'No Transformation','With Transformation'},'FontSize',8,'FontWeight','bold')
saveas(gcf,'energy_error', 'png')
hold off