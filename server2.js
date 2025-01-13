const fs = require('node:fs');
const content = JSON.parse(fs.readFileSync('./output.json', 'utf8'));
// 'title' => fake()->name(),
// 'desc' => fake()->text(),
// 'date' => fake()->date(),
// 'duration' => fake()->time(),
// 'url_film' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
// 'url_trailer' => "4e31983f-20f4-44dc-954a-edb1ce9b50bd",
// 'slug' => fake()->slug(),
const items = new Map();
for (let i = 0; i < content.length; ++i) {
    const currentContent = content[i];
    const newContent = {...currentContent};
    // newContent.id = currentContent.id;
    // newContent.title = currentContent.title;
    // newContent.desc = currentContent.desc;
    // newContent.date = currentContent.date;
    // newContent.duration = currentContent.duration;
    // newContent.url_film = currentContent.url_film;
    // newContent.url_trailer = currentContent.url_trailer;
    // newContent.slug = currentContent.slug;
    //
    newContent.genre = Math.floor(newContent.genre);
    if (!items.has(newContent.id)) {
        items.set(newContent.id, newContent);
    }
}

const finalItems = [];
for(const value of items.values()) {
    finalItems.push(value);
}
console.log(finalItems);
// fs.writeFileSync('/tmp/output2.json', JSON.stringify(finalItems));
fs.writeFileSync('./output2.json', JSON.stringify(finalItems));
