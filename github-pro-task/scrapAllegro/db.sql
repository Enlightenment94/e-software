#YYYY-MM-DD HH:MM:SS
create table pr_scrap_allegro(
    id_product int(13),
    scrap_time DATETIME,
    competition_auction_id BIGINT UNIQUE,
	condition_item varchar(16),
    price varchar(64)
)
