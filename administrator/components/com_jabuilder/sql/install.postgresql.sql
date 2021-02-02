DROP TABLE IF EXISTS "#__jabuilder_pages";

CREATE TABLE "#__jabuilder_pages" (
  "id" serial NOT NULL,
  "title" text NOT NULL DEFAULT '',
  "alias" text NOT NULL DEFAULT '',
  "slug" varchar(255) NOT NULL DEFAULT '',
  "type" text NOT NULL DEFAULT '',
  "content" text NOT NULL DEFAULT '',
  "data" text NOT NULL DEFAULT '',
  "parent" int NOT NULL DEFAULT 0,
  "state" int NOT NULL DEFAULT 0,
  "access" int NOT NULL DEFAULT '1',
  "params" text NOT NULL DEFAULT '',
  "published_date" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "modified_date" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  PRIMARY KEY ("id")
);

DROP TABLE IF EXISTS "#__jabuilder_revisions";

CREATE TABLE "#__jabuilder_revisions" (
  "id" serial NOT NULL,
  "itemid" bigint NOT NULL DEFAULT 0,
  "itemtype" varchar(10) NOT NULL DEFAULT '',
  "data" text NOT NULL DEFAULT '',
  "rev" int NOT NULL DEFAULT 0,
  "created" timestamp without time zone DEFAULT '1970-01-01 00:00:00' NOT NULL,
  "note" varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY ("id")
);