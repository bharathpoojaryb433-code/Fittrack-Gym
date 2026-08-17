function createWorkoutChart(canvasId, labels, values) {

    const canvas = document.getElementById(canvasId);

    if (!canvas) return;

    const ctx = canvas.getContext("2d");

    const width = canvas.width;
    const height = canvas.height;

    ctx.clearRect(0, 0, width, height);

    const maxValue = Math.max(...values, 1);

    const barWidth = width / values.length * 0.55;

    values.forEach((value, index) => {

        const barHeight =
            (value / maxValue) * (height - 70);

        const x =
            index * (width / values.length) +
            20;

        const y =
            height - barHeight - 40;

        ctx.fillStyle = "#22c55e";

        ctx.fillRect(
            x,
            y,
            barWidth,
            barHeight
        );

        ctx.fillStyle = "#374151";

        ctx.font = "12px Arial";

        ctx.fillText(
            labels[index],
            x,
            height - 15
        );

        ctx.fillText(
            value,
            x + 5,
            y - 5
        );
    });
}