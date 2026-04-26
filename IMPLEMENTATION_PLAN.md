# SWAPI Extended Metadata Implementation Plan

## Goal

Implement a full metadata extension for all main SWAPI resources so API consumers can use richer resource data directly instead of building their own ad hoc extensions.

Resources covered:

- people
- films
- planets
- species
- starships
- vehicles

## Source Data

### Canonical Base Data

Use the current API database records and schema as the source of truth for canonical resource identities:

- resource IDs
- canonical names/titles
- existing relationships

The provided SQL dump confirms the canonical base schema and names.

### Extension Data Sources

#### Source A

Primary content source for:

- `short_description`
- `long_description`
- default image candidates

Also includes:

- `force` values
- images for all resource types

#### Source B

Secondary source for:

- `people.lightsaber_color`
- fallback descriptions where Source A is missing
- additional image candidates

Also includes:

- per-resource image maps
- per-resource short descriptions

## Final API Extension Contract

### People

Add or support:

- `image_url`
- `short_description`
- `long_description`
- `force_alignment`
- `lightsaber_color`
- existing `wiki_link`
- existing `affiliations`

### Films

Add or support:

- `image_url`
- `short_description`
- `long_description`

### Planets

Add:

- `image_url`
- `short_description`
- `long_description`

### Species

Add:

- `image_url`
- `short_description`
- `long_description`

### Starships

Add:

- `image_url`
- `short_description`
- `long_description`

### Vehicles

Add:

- `image_url`
- `short_description`
- `long_description`

## Normalization Strategy

Normalize all extension data against canonical API resources before import.

### Matching Priority

1. Numeric ID mappings where available
2. Exact canonical name/title matches
3. Explicit alias/override mappings

### Alias / Correction Map

Support explicit normalization for known mismatches, including:

- `Aayla Secura` / `Ayla Secura`
- `Bestine IV` / `Bestine 4`
- `Theta-class T-2c shuttle` / `Theta class`
- `Banking clan frigte`
- `Ratts Tyerell`
- slash-vs-ampersand filename variants such as `TIE/LN` / `TIE & LN` and `TIE/IN` / `TIE & IN`

## Source Precedence Rules

### Text Metadata

Use Source A as primary source for:

- `short_description`
- `long_description`

Use Source B only as fallback where Source A is missing or unusable.

### Force Field

- Keep `force` only for `people`
- Rename it to `force_alignment`
- Do not expose `force` for films or other resources

### Lightsaber Color

- Use Source B as the source for `people.lightsaber_color`

## Image Selection Policy

For each canonical resource:

1. Preserve any existing `image_url` from the canonical SQL dump
2. Gather fallback image candidates from all bundled source datasets only when no image is already present
3. Resolve aliases and filename mismatches
4. Measure image dimensions
5. Choose the highest-resolution fallback image by pixel area: `width * height`

### Tie Breakers

If pixel area ties:

1. Prefer better modern format if visually equivalent: `avif > webp > png > jpg/jpeg`
2. If still tied, prefer smaller final optimized file

### Explicit Override Map

Support a small manual image override map for obvious outliers discovered during implementation.

Use this only when strict resolution-based selection produces a clearly worse result.

## Asset Consolidation Strategy

Do not serve raw source asset folders directly.

Copy only selected final fallback images into an API-owned public asset tree:

- `public/images/people/`
- `public/images/films/`
- `public/images/planets/`
- `public/images/species/`
- `public/images/starships/`
- `public/images/vehicles/`

### Filename Strategy

Normalize final filenames to a predictable backend-safe format.

Recommended characteristics:

- lowercase
- hyphenated
- ASCII-safe where practical
- stable and reproducible

## Image Optimization Strategy

Optimize only the final selected asset set, not the raw source folders.

### ImageOptim CLI

Installed at:

`/Users/jn/.nvm/versions/node/v24.15.0/bin/imageoptim`

### Optimization Workflow

1. Finalize image winners
2. Copy winners into public asset tree
3. Run ImageOptim on the final public asset tree

### Recommended Usage

- Run ImageOptim over all final assets
- Include `--imagealpha` for PNG-heavy sets
- Include `--jpegmini` if locally available/configured

This avoids wasting time optimizing duplicate or discarded assets.

## Database Changes

### Existing Partial Extensions Already Present

Current code already partially supports:

- `people.wiki_link`
- `people.image_url`
- `people.affiliations`
- `films.image_url`

### Required New Columns

Add missing nullable columns via migrations.

#### People

- `short_description`
- `long_description`
- `force_alignment`
- `lightsaber_color`

#### Films

- `short_description`
- `long_description`

#### Planets

- `image_url`
- `short_description`
- `long_description`

#### Species

- `image_url`
- `short_description`
- `long_description`

#### Starships

- `image_url`
- `short_description`
- `long_description`

#### Vehicles

- `image_url`
- `short_description`
- `long_description`

Preserve `people.image_url` and `films.image_url` from the canonical dump. Bundled person images are fallback data only for people whose dump row has no image.

## Import Pipeline

Implement a dedicated extension metadata importer.

### Recommended Form

An artisan command or seeder that:

- reads normalized extension data
- resolves records by canonical resource ID
- updates only extension fields
- leaves base SWAPI relational data untouched

### Import Rules

- Import by canonical ID, not raw source names
- Tolerate missing fields
- Tolerate missing images
- Log unresolved records for manual review

## API Response Strategy

Preserve the existing API philosophy:

- index endpoints stay summary-oriented
- show endpoints return richer metadata

### Index Endpoints

Include lightweight extension fields:

- `image_url`
- `short_description`
- `force_alignment` for people

Do not include `long_description` on index responses.

### Show Endpoints

Include full extension fields for the resource.

## Testing Plan

Add feature tests for all resource families.

### Verify

- index endpoints include expected summary extension fields
- show endpoints include full extension fields
- existing relationship counts remain unchanged
- existing nested relationships remain unchanged
- null extension fields do not break responses
- importer resolves aliases correctly
- importer handles missing image candidates safely

## Documentation Updates

Update README and example payloads.

### README

Document:

- extension overview
- setup flow
- import flow
- image handling flow
- image optimization workflow

### API Examples

Add or update examples showing:

- index response with summary extension fields
- show response with full extension fields

### Maintenance Guidance

Document that future course iterations should update the canonical import dataset rather than patching the API ad hoc.

## SQL Dump Strategy

Treat the SQL dump as historical/base data, not the long-term final install artifact.

### Preferred Setup

- migrations for schema
- import commands for extension data

### Optional

Regenerate a fresh SQL dump after the full extension is implemented, if dump-based installs should still be supported.

## Implementation Order

1. Create canonical normalization strategy
2. Define alias and override maps
3. Define final schema
4. Implement image candidate selection logic
5. Implement image override support
6. Add migrations
7. Implement extension importer
8. Consolidate selected images into public asset tree
9. Run ImageOptim on final assets
10. Expose extension fields in API responses
11. Add tests
12. Update documentation

## Key Risks

- name mismatches between source datasets and canonical API records
- poor image selection despite higher resolution
- inconsistent filenames and formats
- large asset footprint if images are not deduplicated first
- stale docs or dump if data flow changes are not documented

## Mitigations

- use canonical ID-based import wherever possible
- maintain explicit alias and image override maps
- optimize only final selected assets
- keep importer separate from base SWAPI relational import
- add tests around normalization and response shape
